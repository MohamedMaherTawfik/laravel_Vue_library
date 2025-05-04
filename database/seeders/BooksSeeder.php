<?php

namespace Database\Seeders;

use App\Models\books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'description' => 'A novel by F. Scott Fitzgerald',
                'image' => 'gatsby.jpg',
                'author' => 'F. Scott Fitzgerald',
                'categories_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'description' => 'A classic novel by Harper Lee',
                'image' => 'mockingbird.jpg',
                'author' => 'Harper Lee',
                'categories_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'description' => 'A novel by J.D. Salinger',
                'image' => 'catcher.jpg',
                'author' => 'J.D. Salinger',
                'categories_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'Brave New World',
                'description' => 'A dystopian novel by Aldous Huxley',
                'image' => 'brave.jpg',
                'author' => 'Aldous Huxley',
                'categories_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'The Lord of the Rings',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'lord.jpg',
                'author' => 'J.R.R. Tolkien',
                'categories_id' => 3,
                'user_id' => 1,
            ],
            [
                'title' => '1984',
                'description' => 'A dystopian novel by George Orwell',
                'image' => '1984.jpg',
                'author' => 'George Orwell',
                'categories_id' => 3,
                'user_id' => 1,
            ],
            [
                'title' => 'The Hobbit',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'hobbit.jpg',
                'author' => 'J.R.R. Tolkien',
                'categories_id' => 4,
                'user_id' => 1,
            ],
            [
                'title' => 'The Lord of the Rings',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'lord.jpg',
                'author' => 'J.R.R. Tolkien',
                'categories_id' => 4,
                'user_id' => 1,
            ],
        ];
        foreach ($books as $book) {
            books::create($book);
        }
    }
}
