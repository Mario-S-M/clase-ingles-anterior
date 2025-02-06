<?php

use Illuminate\Database\Seeder;


use Database\Seeders\EscuelaIngles\LeccionesSeeder;
use Database\Seeders\EscuelaIngles\NivelesInglesSeeder;
use Database\Seeders\EscuelaIngles\PaginaLeccionSeeder;
use Database\Seeders\EscuelaIngles\SeccionesPaginaSeeder;
class DatabaseSeeder extends Seeder
{   
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call(UsersTableSeeder::class);
        //  $this->call(RolesSeeder::class);
        //  $this->call(ModelHasRolesSeeder::class);
        
        //  $this->call(PermissionsTableSeeder::class);
        //  $this->call(RoleHasPermissions::class);
        //  $this->call(MenusTableSeeder::class);

         $this->call(NivelesInglesSeeder::class);
         $this->call(LeccionesSeeder::class);
      
         $this->call(PaginaLeccionSeeder::class);
         $this->call(SeccionesPaginaSeeder::class);
    }
}
