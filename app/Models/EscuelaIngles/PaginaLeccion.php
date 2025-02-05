<?php

namespace App\Models\EscuelaIngles;

use Illuminate\Database\Eloquent\Model;

class PaginaLeccion extends Model
{
    protected $table = 'pagina_leccion';
    protected $primaryKey = 'id_pagina_leccion';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_pagina_leccion',
        'titulo',
        'link_video_frame',
        'link_cuestonario',
        'clv_leccion',
    ];
}
