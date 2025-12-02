<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Please run CategoriesTableSeeder first.');
            return;
        }

        $products = [
            [
                'category_id' => $categories->first()->id,
                'name' => json_encode(['en' => 'Smartphone', 'ru' => 'Смартфон', 'tk' => 'Smartfon']),
                'name_en' => 'Smartphone',
                'name_ru' => 'Смартфон',
                'name_tk' => 'Smartfon',
                'general_info' => json_encode(['en' => 'Latest model smartphone', 'ru' => 'Новейшая модель смартфона', 'tk' => 'Iň täze smartfon modeli']),
                'general_info_en' => 'Latest model smartphone',
                'general_info_ru' => 'Новейшая модель смартфона',
                'general_info_tk' => 'Iň täze smartfon modeli',
                'description' => json_encode(['en' => 'High-quality smartphone with advanced features', 'ru' => 'Высококачественный смартфон с расширенными функциями', 'tk' => 'Ösen aýratynlyklary bolan ýokary hilli smartfon']),
                'description_en' => 'High-quality smartphone with advanced features',
                'description_ru' => 'Высококачественный смартфон с расширенными функциями',
                'description_tk' => 'Ösen aýratynlyklary bolan ýokary hilli smartfon',
                'price' => 599.99,
            ],
            [
                'category_id' => $categories->first()->id,
                'name' => json_encode(['en' => 'Laptop', 'ru' => 'Ноутбук', 'tk' => 'Noutbuk']),
                'name_en' => 'Laptop',
                'name_ru' => 'Ноутбук',
                'name_tk' => 'Noutbuk',
                'general_info' => json_encode(['en' => 'Professional laptop', 'ru' => 'Профессиональный ноутбук', 'tk' => 'Hünärmen noutbuk']),
                'general_info_en' => 'Professional laptop',
                'general_info_ru' => 'Профессиональный ноутбук',
                'general_info_tk' => 'Hünärmen noutbuk',
                'description' => json_encode(['en' => 'Powerful laptop for work and entertainment', 'ru' => 'Мощный ноутбук для работы и развлечений', 'tk' => 'Iş we güýmenje üçin güýçli noutbuk']),
                'description_en' => 'Powerful laptop for work and entertainment',
                'description_ru' => 'Мощный ноутбук для работы и развлечений',
                'description_tk' => 'Iş we güýmenje üçin güýçli noutbuk',
                'price' => 1299.99,
            ],
            [
                'category_id' => $categories->skip(1)->first()->id ?? $categories->first()->id,
                'name' => json_encode(['en' => 'T-Shirt', 'ru' => 'Футболка', 'tk' => 'Futbolka']),
                'name_en' => 'T-Shirt',
                'name_ru' => 'Футболка',
                'name_tk' => 'Futbolka',
                'general_info' => json_encode(['en' => 'Cotton t-shirt', 'ru' => 'Хлопковая футболка', 'tk' => 'Pagta futbolka']),
                'general_info_en' => 'Cotton t-shirt',
                'general_info_ru' => 'Хлопковая футболка',
                'general_info_tk' => 'Pagta futbolka',
                'description' => json_encode(['en' => 'Comfortable cotton t-shirt for everyday wear', 'ru' => 'Удобная хлопковая футболка для повседневной носки', 'tk' => 'Her gün geýmek üçin amatly pagta futbolka']),
                'description_en' => 'Comfortable cotton t-shirt for everyday wear',
                'description_ru' => 'Удобная хлопковая футболка для повседневной носки',
                'description_tk' => 'Her gün geýmek üçin amatly pagta futbolka',
                'price' => 19.99,
            ],
            [
                'category_id' => $categories->skip(2)->first()->id ?? $categories->first()->id,
                'name' => json_encode(['en' => 'Garden Tools Set', 'ru' => 'Набор садовых инструментов', 'tk' => 'Bag gurallarynyň toplumy']),
                'name_en' => 'Garden Tools Set',
                'name_ru' => 'Набор садовых инструментов',
                'name_tk' => 'Bag gurallarynyň toplumy',
                'general_info' => json_encode(['en' => 'Complete garden tools', 'ru' => 'Полный набор садовых инструментов', 'tk' => 'Doly bag gurallary']),
                'general_info_en' => 'Complete garden tools',
                'general_info_ru' => 'Полный набор садовых инструментов',
                'general_info_tk' => 'Doly bag gurallary',
                'description' => json_encode(['en' => 'Professional garden tools set for all your gardening needs', 'ru' => 'Профессиональный набор садовых инструментов для всех ваших садовых нужд', 'tk' => 'Ähli bag işleri üçin hünärmen gurallar toplumy']),
                'description_en' => 'Professional garden tools set for all your gardening needs',
                'description_ru' => 'Профессиональный набор садовых инструментов для всех ваших садовых нужд',
                'description_tk' => 'Ähli bag işleri üçin hünärmen gurallar toplumy',
                'price' => 89.99,
            ],
            [
                'category_id' => $categories->skip(3)->first()->id ?? $categories->first()->id,
                'name' => json_encode(['en' => 'Football', 'ru' => 'Футбольный мяч', 'tk' => 'Futbol topy']),
                'name_en' => 'Football',
                'name_ru' => 'Футбольный мяч',
                'name_tk' => 'Futbol topy',
                'general_info' => json_encode(['en' => 'Professional football', 'ru' => 'Профессиональный футбольный мяч', 'tk' => 'Hünärmen futbol topy']),
                'general_info_en' => 'Professional football',
                'general_info_ru' => 'Профессиональный футбольный мяч',
                'general_info_tk' => 'Hünärmen futbol topy',
                'description' => json_encode(['en' => 'High-quality football for professional play', 'ru' => 'Высококачественный футбольный мяч для профессиональной игры', 'tk' => 'Hünärmen oýun üçin ýokary hilli futbol topy']),
                'description_en' => 'High-quality football for professional play',
                'description_ru' => 'Высококачественный футбольный мяч для профессиональной игры',
                'description_tk' => 'Hünärmen oýun üçin ýokary hilli futbol topy',
                'price' => 29.99,
            ],
            [
                'category_id' => $categories->skip(4)->first()->id ?? $categories->first()->id,
                'name' => json_encode(['en' => 'Programming Book', 'ru' => 'Книга по программированию', 'tk' => 'Programmirlemek kitaby']),
                'name_en' => 'Programming Book',
                'name_ru' => 'Книга по программированию',
                'name_tk' => 'Programmirlemek kitaby',
                'general_info' => json_encode(['en' => 'Learn programming', 'ru' => 'Изучите программирование', 'tk' => 'Programmirlemegi öwreniň']),
                'general_info_en' => 'Learn programming',
                'general_info_ru' => 'Изучите программирование',
                'general_info_tk' => 'Programmirlemegi öwreniň',
                'description' => json_encode(['en' => 'Comprehensive guide to modern programming', 'ru' => 'Полное руководство по современному программированию', 'tk' => 'Häzirki zaman programmirlemek boýunça doly gollanma']),
                'description_en' => 'Comprehensive guide to modern programming',
                'description_ru' => 'Полное руководство по современному программированию',
                'description_tk' => 'Häzirki zaman programmirlemek boýunça doly gollanma',
                'price' => 49.99,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
