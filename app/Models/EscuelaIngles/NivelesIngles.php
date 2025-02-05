<?php

namespace App\Models\EscuelaIngles;

use Illuminate\Database\Eloquent\Model;

class NivelesIngles extends Model
{
    protected $table = 'niveles_ingles';
    protected $primaryKey = 'id_nivel_ingles';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_nivel_ingles',
        'nombre_nivel'
    ];
}
