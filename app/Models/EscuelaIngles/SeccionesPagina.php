<?php

namespace App\Models\EscuelaIngles;

use Illuminate\Database\Eloquent\Model;

class SeccionesPagina extends Model
{
    protected $table = 'secciones_pagina';
    protected $primaryKey = 'id_seccion_pagina';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_seccion_pagina',
        'clv_pagina_leccion',
        'imagen',
        'descripcion_imagen',
        'contenido',
    ];
}
