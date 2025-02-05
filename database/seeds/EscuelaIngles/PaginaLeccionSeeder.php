<?php

namespace Database\Seeders\EscuelaIngles;

use Illuminate\Database\Seeder;
use App\Models\EscuelaIngles\PaginaLeccion;


class PaginaLeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      
        PaginaLeccion::create([
            'titulo' => 'Esta es una prueba de la leccion 1',
            'link_video_frame' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8iLPYo9p3I0?si=OBjAquAOLCQ21MKM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            'link_cuestonario' => "https://docs.google.com/forms/d/e/1FAIpQLSe3jtwKXktHEPQQfkt0T7FtIjNgXgf7DcJpQY2F92WsbpE_eA/closedform",
            'clv_leccion' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
