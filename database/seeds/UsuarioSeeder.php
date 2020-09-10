<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Yesid',
            'email'=>'correo@correo.com',
            'password'=>Hash::make('12345678'),
            'url'=>'https://www.cardenasingenieros.com',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_At'=>date('Y-m-d H:i:s'),

        ]);

        DB::table('users')->insert([
            'name'=>'Oscar',
            'email'=>'correo2@correo.com',
            'password'=>Hash::make('12345678'),
            'url'=>'https://www.cardenasingenieros.com',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_At'=>date('Y-m-d H:i:s'),

        ]);
    }
}
