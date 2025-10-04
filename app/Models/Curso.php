<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre', 
        'descripcion',
        'url_imagen_de_portada',
        'categoria', //enum
        'nivel', //enum
        'precio',
        'cupos',
        'certificacion', //enum
        'requisitos', //json
        'metas', //json
        'numero_de_contacto', 
        'direccion',
        'email_contacto',
        'redes_sociales', //json
        'user_id', //foreignId
        'fecha_inicio',
        'fecha_fin',
        'estado', //enum
        'destacado', //boolean
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'metas' => 'array',
        'requisitos' => 'array',
        'redes_sociales' => 'array',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'destacado' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
