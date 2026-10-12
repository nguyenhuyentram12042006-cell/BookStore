<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Nguyễn Nhật Ánh',
                'nationality' => 'Việt Nam',
            ],
            [
                'name' => 'Dale Carnegie',
                'nationality' => 'Mỹ',
            ],
            [
                'name' => 'Paulo Coelho',
                'nationality' => 'Brazil',
            ],
            [
                'name' => 'Robert T. Kiyosaki',
                'nationality' => 'Mỹ',
            ],
            [
                'name' => 'James Clear',
                'nationality' => 'Mỹ',
            ],
        ];

        foreach ($authors as $author) {
            Author::firstOrCreate(
                ['slug' => Str::slug($author['name'])],
                [
                    'name' => $author['name'],
                    'nationality' => $author['nationality'],
                ]
            );
        }
    }
}
