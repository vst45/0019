<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'Кабачки',
            'Капуста',
            'Картопля',
            'Цибуля',
            'Морква',
            'Огірки',
            'Перець',
            'Петрушка',
            'Помідори',
            'Редька',
            'Буряк',
            'Часник',
            'Кріп'
        ];

        foreach ($list as $item) {
            DB::table('products')->insert([
                'name' => $item,
            ]);
        }

        //
    }
}
