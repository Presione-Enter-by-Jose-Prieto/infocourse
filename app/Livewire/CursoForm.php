<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CursoForm extends Component
{
    use WithFileUploads;

    public $user;
    
    // Propiedades principales del curso
    public $nombre, $descripcion, $imagen, $url_imagen_de_portada, 
    $categoria = 'otra', $nivel = 'basico', $precio, $cupos, $certificacion = 'no',
    $requisitos, $metas, $numero_de_contacto, $direccion,
    $email_contacto, $user_id, $fecha_inicio,
    $fecha_fin, $estado = 'borrador', $destacado = false;
    
    // Propiedades para redes sociales
    public $facebook_url, $instagram_url, $youtube_url, $twitter_url, $linkedin_url;

    public function mount()
    {
        $this->user = User::all();
    }

    public function save()
    {
        $user = Auth::user();
        
        if (!$user) {
            session()->flash('error', 'Debes iniciar sesión para crear un curso.');
            return;
        }

        $url_imagen = null;
        if($this->url_imagen_de_portada)
        {
            $url_imagen = $this->url_imagen_de_portada->store('portadas_cursos', 'public');
        }

        // Procesar metas y requisitos a arrays
        $metasArray = array_values(array_filter(
            array_map('trim', 
                explode("\n", $this->metas ?? '')
            ),
            function($item) {
                return $item !== '';
            }
        ));

        $requisitosArray = array_values(array_filter(
            array_map('trim', 
                explode("\n", $this->requisitos ?? '')
            ),
            function($item) {
                return $item !== '';
            }
        ));
        
        // Procesar redes sociales
        $redes_sociales = [
            'facebook' => $this->facebook_url,
            'instagram' => $this->instagram_url,
            'youtube' => $this->youtube_url,
            'twitter' => $this->twitter_url,
            'linkedin' => $this->linkedin_url
        ];
        
        // Filtrar valores vacíos
        $redes_sociales = array_filter($redes_sociales, function($value) {
            return !empty($value);
        });

        Curso::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'url_imagen_de_portada' => $url_imagen,
            'categoria' => $this->categoria,
            'nivel' => $this->nivel,
            'precio' => $this->precio,
            'cupos' => $this->cupos,
            'certificacion' => $this->certificacion,
            'metas' => json_encode($metasArray),
            'requisitos' => json_encode($requisitosArray),
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'numero_de_contacto' => $this->numero_de_contacto,
            'email_contacto' => $this->email_contacto,
            'direccion' => $this->direccion,
            'redes_sociales' => $redes_sociales,
            'user_id' => $user->id,
            'estado' => $this->estado,
            'destacado' => $this->destacado ?? false,
        ]);

        session()->flash('message', 'Curso creado exitosamente.');
        
        // Reset form fields
        $this->reset([
            'nombre', 'descripcion', 'url_imagen_de_portada', 'imagen', 'categoria', 'nivel', 
            'precio', 'cupos', 'certificacion', 'fecha_inicio', 'requisitos', 'metas',
            'fecha_fin', 'estado', 'destacado', 'numero_de_contacto',
            'direccion', 'email_contacto', 'facebook_url', 'instagram_url', 'youtube_url',
            'twitter_url', 'linkedin_url'
        ]);
        
        // Emit event to scroll to top
        $this->dispatch('scrollToTop');
    }

    public function formatear()
    {
        $this->reset([
            'nombre', 'descripcion', 'url_imagen_de_portada',
            'categoria', 'nivel', 'precio', 'cupos', 'certificacion',
            'requisitos', 'metas', 'numero_de_contacto', 'direccion', 
            'email_contacto', 'fecha_inicio', 'fecha_fin', 'estado', 'destacado',
            'facebook_url', 'instagram_url', 'youtube_url', 'twitter_url', 'linkedin_url'
        ]);
    }

    public function render()
    {
        return view('livewire.curso-form');
    }
}
