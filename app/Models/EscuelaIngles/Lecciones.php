<?php

namespace App\Models\EscuelaIngles;

use Illuminate\Database\Eloquent\Model;

class Lecciones extends Model
{
    protected $table = 'leccion';
    protected $primaryKey = 'id_leccion';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_leccion',
        'titulo_leccion',
        'descripcion',
        'clv_nivel_ingles'
    ];
}
