<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['title' => 'Другое', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Овощи', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Цветы', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Деревья', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Кактусы', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}