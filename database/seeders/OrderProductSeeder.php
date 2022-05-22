<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = Product::all();
        $orders = Order::all();

        $stocks = collect([
            'Вінниця',
            'Дніпро',
            'Донецьк',
            'Житомир',
            'Запоріжжя',
            'Івано-Франківськ',
            'Київ',
            'Кропивницький',
            'Луганськ',
            'Луцьк',
            'Львів',
            'Миколаїв',
            'Одеса',
            'Полтава',
            'Рівне',
            'Суми',
            'Тернопіль',
            'Ужгород',
            'Харків',
            'Херсон',
            'Хмельницький',
            'Черкаси',
            'Чернівці',
            'Чернігів'
        ]);

        for ($i = 0; $i < 1000; $i++) {
            DB::table('order_product')->insert([
                'order_id' => $orders->random()->id,
                'product_id' => $products->random()->id,
                'delivery_date' => date('Y-m-d', random_int(time() - 3600 * 24 * 30, time() + 3600 * 24 * 30)),
                'stock' => $stocks->random(),
            ]);
        }
    }
}
