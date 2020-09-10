<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categoria_receta')->insert([
            'nombre'=>'Carnes',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_At'=>date('Y-m-d H:i:s'),

        ]);
        DB::table('categoria_receta')->insert([
            'nombre'=>'Hamburguesas',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_At'=>date('Y-m-d H:i:s'),

        ]);
        DB::table('categoria_receta')->insert([
            'nombre'=>'Pizzas',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_At'=>date('Y-m-d H:i:s'),

        ]);
    }
}
