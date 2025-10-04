<div class="flex h-full w-full flex-1 flex-col">
    <div class="relative h-full flex-1 overflow-auto">
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm dark:border-slate-600/50 dark:bg-[#171717] mb-8">
            <div class="px-4 py-3 sm:px-5 border-b border-slate-200 dark:border-slate-600/50 bg-slate-100/80 dark:bg-slate-800/30">
                <div class="flex items-center justify-between">
                    <h3 class="flex items-center text-lg font-semibold text-slate-800 dark:text-slate-200">
                        <svg class="mr-2 h-5 w-5 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Nuevo Curso
                    </h3>
                    @if (session()->has('message'))
                        <div data-message class="rounded-lg bg-green-100 px-3 py-1 text-sm font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400 transition-opacity duration-300" style="transition-property: opacity;">
                            <div class="flex items-center">
                                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ session('message') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="px-4 py-3 sm:px-5">
                <p class="text-sm text-gray-600 dark:text-gray-300">Complete todos los campos obligatorios marcados con <span class="text-red-500">*</span> para crear un nuevo curso.</p>
            </div>
        </div>
        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
            <!-- Sección de Información Básica -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Información Básica
                    </h3>
                    
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Nombre del Curso -->
                        <div class="sm:col-span-6">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nombre del Curso <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="text" 
                                    id="nombre" 
                                    wire:model="nombre"
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="Introduce el nombre del curso"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="sm:col-span-6">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Descripción <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <textarea 
                                    id="descripcion" 
                                    rows="4" 
                                    wire:model="descripcion"
                                    class="auto-resize-textarea block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="Describe el contenido del curso, objetivos y a quién va dirigido..."
                                    oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
                                    style="min-height: 80px; overflow-y: hidden; resize: none;"
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <!-- Imagen de Portada -->
                        <div class="sm:col-span-6">
                            <label for="imagen_de_portada" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Imagen de Portada
                            </label>
                            <div class="mt-2 w-full" x-data="{ imagePreview: '' }" x-init="
                                Livewire.on('saved', () => {
                                    imagePreview = '';
                                    const fileInput = $refs.fileInput;
                                    if (fileInput) fileInput.value = '';
                                });
                            ">
                                <div class="relative mt-1 flex h-32 w-full flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 py-4 bg-white hover:border-blue-200 transition-colors duration-200 dark:border-[#404040] dark:bg-[#1f1f1f] dark:hover:border-blue-300 group cursor-pointer" @click="$refs.fileInput.click()">
                                    <div class="flex flex-col items-center space-y-1 text-center">
                                        <template x-if="imagePreview">
                                            <div class="h-20 w-20 flex items-center justify-center overflow-hidden rounded-md bg-gray-100 dark:bg-gray-700">
                                                <img :src="imagePreview" alt="Vista previa de la imagen" class="max-h-full max-w-full object-contain">
                                            </div>
                                        </template>
                                        <div x-show="imagePreview" class="mt-1">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Toca para cambiar de imagen
                                            </p>
                                        </div>
                                        <div x-show="!imagePreview" class="flex flex-col items-center">
                                            <svg class="h-10 w-10 text-gray-400 group-hover:text-blue-300 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <div class="space-y-1">
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    PNG, JPG o GIF (máx. 5MB)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <input 
                                        type="file" 
                                        x-ref="fileInput"
                                        wire:model="url_imagen_de_portada"
                                        class="hidden"
                                        accept="image/png, image/jpeg, image/gif"
                                        @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = e => imagePreview = e.target.result;
                                                reader.readAsDataURL(file);
                                            } else {
                                                imagePreview = '';
                                            }
                                        "
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Fechas del Curso -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fechas del Curso
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Fecha de Inicio -->
                        <div class="sm:col-span-3">
                            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha de inicio <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="date" 
                                    wire:model="fecha_inicio"
                                    id="fecha_inicio" 
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Fecha de Finalización -->
                        <div class="sm:col-span-3">
                            <label for="fecha_fin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha de finalización <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="date" 
                                    id="fecha_fin"
                                    wire:model="fecha_fin" 
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Categorización y Detalles -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categorización y Detalles
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Categoría -->
                        <div class="sm:col-span-3">
                            <label for="categoria" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Categoría <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select 
                                    wire:model="categoria"
                                    id="categoria" 
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    required
                                >
                                    <option value="deportiva">Deportiva</option>
                                    <option value="pedagogica">Pedagógica</option>
                                    <option value="disciplinaria">Disciplinaria</option>
                                    <option value="idiomatica">Idiomática</option>
                                    <option value="otra">Otra</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nivel -->
                        <div class="sm:col-span-3">
                            <label for="nivel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nivel <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select 
                                    id="nivel" 
                                    wire:model="nivel"
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    required
                                >
                                    <option value="basico">Básico</option>
                                    <option value="intermedio">Intermedio</option>
                                    <option value="avanzado">Avanzado</option>
                                </select>
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="sm:col-span-2">
                            <label for="precio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Precio (COP) <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input 
                                    type="number" 
                                    id="precio" 
                                    wire:model="precio"
                                    min="0" 
                                    step="1000"
                                    class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none block w-full pl-7 pr-12 rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="0"
                                    required
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">COP</span>
                                </div>
                            </div>
                        </div>

                        <!-- Cupos -->
                        <div class="sm:col-span-2">
                            <label for="cupos" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cupos disponibles <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="number" 
                                    id="cupos" 
                                    wire:model="cupos"
                                    min="1"
                                    class="[appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="Ej: 20"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Certificación -->
                        <div class="sm:col-span-2">
                            <label for="certificacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Incluye certificación <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <select 
                                    id="certificacion"
                                    wire:model="certificacion"
                                    class="block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    required
                                >
                                    <option value="">Seleccione</option>
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Metas del Curso -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Metas del Curso
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="metas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Metas de aprendizaje
                                    <span class="text-xs text-gray-500 dark:text-gray-400">(Una por línea)</span>
                                </label>
                                <div class="mt-1">
                                    <textarea 
                                        id="metas" 
                                        wire:model="metas"
                                        rows="4" 
                                        class="auto-resize-textarea block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                        placeholder="Ejemplo: Aprender los fundamentos básicos..."
                                        oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
                                        style="min-height: 80px; overflow-y: hidden; resize: none;"
                                    >{{ old('metas', $metas ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Requisitos del Curso -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Requisitos del Curso
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="requisitos" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Requisitos para los participantes
                                    <span class="text-xs text-gray-500 dark:text-gray-400">(Uno por línea)</span>
                                </label>
                                <div class="mt-1">
                                    <textarea 
                                        id="requisitos" 
                                        wire:model="requisitos"
                                        rows="4" 
                                        class="auto-resize-textarea block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                        placeholder="Ejemplo: Conocimientos básicos de..."
                                        oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px';"
                                        style="min-height: 80px; overflow-y: hidden; resize: none;"
                                    >{{ old('requisitos', $requisitos ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Información de Contacto y Redes Sociales -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        Información de Contacto
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Número de Contacto -->
                        <div class="sm:col-span-3">
                            <label for="telefono_contacto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Número de Teléfono de Contacto <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="tel" 
                                    id="telefono_contacto" 
                                    wire:model="numero_de_contacto"
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="Ej: +1234567890"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Correo Electrónico de Contacto -->
                        <div class="sm:col-span-3">
                            <label for="email_contacto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Correo Electrónico de Contacto 
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="email" 
                                    id="email_contacto" 
                                    wire:model="email_contacto"
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="contacto@ejemplo.com"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="sm:col-span-6">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Dirección <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input 
                                    type="text" 
                                    id="direccion" 
                                    wire:model="direccion"
                                    class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-gray-400 focus:ring-1 focus:ring-gray-400 sm:text-sm dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="Dirección completa del lugar donde se impartirá el curso"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Redes Sociales -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Redes Sociales
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6">
                        <!-- Facebook -->
                        <div class="sm:col-span-6">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="facebook_url" 
                                    wire:model="facebook_url"
                                    class="block w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="https://facebook.com/pagina"
                                >
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="sm:col-span-6">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="instagram_url" 
                                    wire:model="instagram_url"
                                    class="block w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-pink-500 focus:ring-1 focus:ring-pink-500 dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="https://instagram.com/usuario"
                                >
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div class="sm:col-span-6">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="youtube_url" 
                                    wire:model="youtube_url"
                                    class="block w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="https://youtube.com/canal"
                                >
                            </div>
                        </div>

                        <!-- Twitter -->
                        <div class="sm:col-span-6">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="twitter_url" 
                                    wire:model="twitter_url"
                                    class="block w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-blue-400 focus:ring-1 focus:ring-blue-400 dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="https://twitter.com/usuario"
                                >
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="sm:col-span-6">
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="linkedin_url" 
                                    wire:model="linkedin_url"
                                    class="block w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600 dark:border-[#404040] dark:bg-[#1f1f1f] dark:text-white"
                                    placeholder="https://linkedin.com/in/usuario"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Acciones -->
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-[#fafafa] shadow-sm dark:border-[#404040] dark:bg-[#171717] mt-8">
                <div class="px-4 py-3 sm:px-5 border-b border-gray-200 dark:border-[#404040]">
                    <h3 class="flex items-center text-base font-medium text-gray-900 dark:text-white">
                        <svg class="mr-2 h-4 w-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Acciones
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-end space-x-2">
                        <!-- Botón Resetear Formulario -->
                        <flux:button 
                            type="button" 
                            variant="danger"
                            wire:click="formatear"
                            wire:confirm="¿Estás seguro de que deseas restablecer el formulario? Se perderán todos los datos ingresados."
                            wire:loading.attr="disabled"
                            wire:target="formatear"
                            class="inline-flex items-center justify-center w-40 px-5 py-2 text-sm font-medium text-white bg-[#e7000b] hover:bg-[#fb2c36] rounded-lg transition-colors duration-150 focus:outline-none focus:ring-0 focus:ring-offset-0 active:ring-0 active:ring-offset-0 focus:border-0 focus:shadow-none"
                            style="-webkit-tap-highlight-color: transparent; outline: none !important;"
                        >
                            <span wire:loading.class="hidden" wire:target="formatear" class="flex items-center">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Resetear</span>
                            </span>
                            <span wire:loading.class.remove="hidden" wire:target="formatear" class="hidden">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </flux:button>
                        
                        <!-- Botón Crear Curso -->
                        <flux:button 
                            type="submit"
                            variant="primary"
                            wire:loading.attr="disabled"
                            wire:target="save"
                            class="inline-flex items-center justify-center w-36 px-5 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors duration-150 focus:outline-none focus:ring-0 focus:ring-offset-0 active:ring-0 active:ring-offset-0 focus:border-0 focus:shadow-none"
                            style="-webkit-tap-highlight-color: transparent; outline: none !important;"
                        >
                            <span wire:loading.class="hidden" wire:target="save" class="flex items-center">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                <span>Guardar</span>
                            </span>
                            <span wire:loading.class.remove="hidden" wire:target="save" class="hidden">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </flux:button>
                    </div>
                </div>
            </div>
        </form>
        
        <script>
            // Resetear la vista previa cuando se restablece el formulario
            document.addEventListener('livewire:resetForm', function() {
                const fileInput = document.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.value = '';
                }
                
                // Resetear la vista previa de Alpine
                const alpineComponent = document.querySelector('[x-data]').__x.$data;
                if (alpineComponent) {
                    alpineComponent.imagePreview = '';
                }
            });
        </script>

        <style>
            /* Estilo para textareas que se autoajustan */
            .auto-resize-textarea {
                transition: height 0.2s ease-out;
                min-height: 80px;
                max-height: 300px;
            }
            
            /* Asegurar que el textarea mantenga el espaciado correcto */
            .auto-resize-textarea:focus {
                outline: none;
                box-shadow: 0 0 0 1px rgba(156, 163, 175, 0.5);
            }
        </style>
        
        <script>
            // Función para inicializar la altura de los textareas
            function initTextareaHeight() {
                document.querySelectorAll('.auto-resize-textarea').forEach(textarea => {
                    // Ajustar altura inicial
                    textarea.style.height = 'auto';
                    textarea.style.height = (textarea.scrollHeight) + 'px';
                    
                    // Asegurar que el evento input esté configurado
                    if (!textarea.getAttribute('data-initialized')) {
                        textarea.setAttribute('data-initialized', 'true');
                        textarea.addEventListener('input', function() {
                            this.style.height = 'auto';
                            this.style.height = (this.scrollHeight) + 'px';
                        });
                    }
                });
            }
            
            // Inicializar cuando el documento esté listo
            document.addEventListener('DOMContentLoaded', initTextareaHeight);
            
            // Inicializar cuando Livewire actualice el DOM
            document.addEventListener('livewire:initialized', () => {
                @this.on('scrollToTop', () => {
                    // Desplazamiento suave al principio
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    
                    // Ocultar el mensaje después de 5 segundos
                    setTimeout(() => {
                        const messageElement = document.querySelector('[data-message]');
                        if (messageElement) {
                            messageElement.style.opacity = '0';
                            setTimeout(() => {
                                messageElement.remove();
                            }, 300); // Tiempo para la transición de desvanecimiento
                        }
                    }, 5000); // 5 segundos
                });
            });
        </script>
    </div>
</div>