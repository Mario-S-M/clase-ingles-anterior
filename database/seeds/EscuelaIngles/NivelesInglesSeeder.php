<?php

namespace Database\Seeders\EscuelaIngles;

use Illuminate\Database\Seeder;
use App\Models\EscuelaIngles\NivelesIngles;
use Illuminate\Support\Facades\DB;

class NivelesInglesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NivelesIngles::create([
            'nombre_nivel' => 'Nivel A1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        NivelesIngles::create([
            'nombre_nivel' => 'Nivel A2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        NivelesIngles::create([
            'nombre_nivel' => 'Nivel B1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        NivelesIngles::create([
            'nombre_nivel' => 'Nivel B2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        NivelesIngles::create([
            'nombre_nivel' => 'Nivel C1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        NivelesIngles::create([
            'nombre_nivel' => 'Nivel C2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('niveles_ingles_users')->insert(
            ['enrol_nivel_ingles' => 1, 'id_user' => 1,'created_at' => now(), 'updated_at' => now()]
           
        );

        DB::table('niveles_ingles_users')->insert(
            ['enrol_nivel_ingles' => 2, 'id_user' => 1,'created_at' => now(), 'updated_at' => now()]
        );

        

    }
}
