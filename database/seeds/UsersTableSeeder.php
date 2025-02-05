<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'nombre' => 'Test',
                'apellido_paterno' => 'test',
                'apellido_materno' => 'test',
                'email' => '1@1',
                'usuario' => 'admin',
                'id_rol' => '1',
                'email_verified_at' => '2019-05-20 11:18:46',
                'password' => '$2y$10$oZl8GHHUuYhBF02IOs5.r.NfwfFvQM9G1a5XGa/U905R..x0kiNtG',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
    
}
