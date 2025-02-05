<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (


            1 =>
            array (
                'id' => '1',
                'name' =>'SuperAdmin',
                'guard_name' =>'web',
            ),
            2 =>
            array (
                'id' => '2',
                'name' =>'Admin',
                'guard_name' =>'web',
            ),
            3 =>
            array (
                'id' => '3',
                'name' =>'Ver',
                'guard_name' =>'web',
            ),

            4 =>
            array (
                'id' => '4',
                'name' =>'Editar',
                'guard_name' =>'web',
            ),
            5 =>
            array (
                'id' => '5',
                'name' =>'Crear',
                'guard_name' =>'web',
            ),
            array (
                'id' => '6',
                'name' =>'MenuRoles',
                'guard_name' =>'web',
            ),
        ));
    }
}
