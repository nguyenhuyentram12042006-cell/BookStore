<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'name' => 'Mắt Biếc',
                'category' => 'Văn học',
                'author' => 'Nguyễn Nhật Ánh',
                'price' => 85000,
                'stock' => 20,
                'publisher' => 'NXB Trẻ',
                'publication_year' => 2019,
            ],
            [
                'name' => 'Đắc Nhân Tâm',
                'category' => 'Kỹ năng sống',
                'author' => 'Dale Carnegie',
                'price' => 79000,
                'stock' => 30,
                'publisher' => 'NXB Tổng hợp TP.HCM',
                'publication_year' => 2020,
            ],
            [
                'name' => 'Nhà Giả Kim',
                'category' => 'Văn học',
                'author' => 'Paulo Coelho',
                'price' => 68000,
                'stock' => 25,
                'publisher' => 'NXB Hội Nhà Văn',
                'publication_year' => 2021,
            ],
            [
                'name' => 'Cha Giàu Cha Nghèo',
                'category' => 'Kinh tế',
                'author' => 'Robert T. Kiyosaki',
                'price' => 99000,
                'stock' => 15,
                'publisher' => 'NXB Trẻ',
                'publication_year' => 2020,
            ],
            [
                'name' => 'Atomic Habits - Thay Đổi Tí Hon, Hiệu Quả Bất Ngờ',
                'category' => 'Kỹ năng sống',
                'author' => 'James Clear',
                'price' => 109000,
                'stock' => 18,
                'publisher' => 'NXB Thế Giới',
                'publication_year' => 2021,
            ],
        ];

        foreach ($books as $item) {
            $category = Category::where(
                'slug',
                Str::slug($item['category'])
            )->firstOrFail();

            $author = Author::where(
                'slug',
                Str::slug($item['author'])
            )->firstOrFail();

            Book::firstOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => $category->id,
                    'author_id' => $author->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'publisher' => $item['publisher'],
                    'publication_year' => $item['publication_year'],
                    'is_active' => true,
                    'description' => 'Sách hay được giới thiệu tại BookStore.',
                ]
            );
        }
    }
}
