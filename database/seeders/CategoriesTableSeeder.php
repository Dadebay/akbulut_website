<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Electronics', 'ru' => 'Электроника', 'tk' => 'Elektronika']),
                'name_en' => 'Electronics',
                'name_ru' => 'Электроника',
                'name_tk' => 'Elektronika',
            ],
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Clothing', 'ru' => 'Одежда', 'tk' => 'Eşik']),
                'name_en' => 'Clothing',
                'name_ru' => 'Одежда',
                'name_tk' => 'Eşik',
            ],
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Home & Garden', 'ru' => 'Дом и сад', 'tk' => 'Öý we bag']),
                'name_en' => 'Home & Garden',
                'name_ru' => 'Дом и сад',
                'name_tk' => 'Öý we bag',
            ],
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Sports', 'ru' => 'Спорт', 'tk' => 'Sport']),
                'name_en' => 'Sports',
                'name_ru' => 'Спорт',
                'name_tk' => 'Sport',
            ],
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Books', 'ru' => 'Книги', 'tk' => 'Kitaplar']),
                'name_en' => 'Books',
                'name_ru' => 'Книги',
                'name_tk' => 'Kitaplar',
            ],
            [
                'type' => 'main',
                'parent_id' => null,
                'name' => json_encode(['en' => 'Food & Beverages', 'ru' => 'Еда и напитки', 'tk' => 'Iýmit we içgiler']),
                'name_en' => 'Food & Beverages',
                'name_ru' => 'Еда и напитки',
                'name_tk' => 'Iýmit we içgiler',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
