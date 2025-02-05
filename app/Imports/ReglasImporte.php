<?php

namespace App\Imports;

use App\Models\LogRegla;
use App\Models\Regla;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReglasImporte implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $acciones = [1 => 'ALLOW', 2 => 'BLOCK'];
        $direcciones = [1 => 1, 2 => 2, 3 => [1,2], 4 => 3, 5 => [1,3], 6 => [2,3], 7 => [1,2,3]];
        
        $regla = substr($row['regla'],1,-1);
        $accion = array_search(substr($row['estatus'],1,-1), $acciones) ;
        $direccion = $direcciones[substr($row['direccion'],1,-1)];
        
        $aux = Regla::select('regla')->where('regla',$regla)->first();
        
        if($aux == NULL)
        {
            $reglas = Regla::create([
                'regla' => $regla,
                'descripcion' => 'Regla importada.',
                'accion_id' => $accion,
                'estatus_regla_id' => 1,
                'tipo_correo_id' => 5,
                'usuario_id' => auth()->user()->id,
                'fecha_creacion' => date('Y-m-d H:m:s')
            ]);
            $reglas->direcciones()->attach($direccion);
            
            $log = LogRegla::create([
                'regla_id'  => $reglas->id,
                'usuario_id'  => auth()->user()->id,
                'estatus_id'  => 3,
                'nota'  => 'Regla importada.'
            ]);
        }
    }
}
