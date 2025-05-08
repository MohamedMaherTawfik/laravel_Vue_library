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
                'image' => 'gatsby.webp',
                'author' => 'F. Scott Fitzgerald',
                'price' => 9.99,
                'categories_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'description' => 'A classic novel by Harper Lee',
                'image' => 'mockinbird.jpg',
                'author' => 'Harper Lee',
                'price' => 8.99,
                'categories_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'description' => 'A novel by J.D. Salinger',
                'image' => 'catcher.jpg',
                'author' => 'J.D. Salinger',
                'price' => 7.99,
                'categories_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'Brave New World',
                'description' => 'A dystopian novel by Aldous Huxley',
                'image' => 'newworld.jpg',
                'author' => 'Aldous Huxley',
                'price' => 6.99,
                'categories_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'The Lord of the Rings',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'lord.jpg',
                'author' => 'J.R.R. Tolkien',
                'price' => 5.99,
                'categories_id' => 3,
                'user_id' => 1,
            ],
            [
                'title' => '1984',
                'description' => 'A dystopian novel by George Orwell',
                'image' => '1984.jpg',
                'author' => 'George Orwell',
                'price' => 4.99,
                'categories_id' => 3,
                'user_id' => 1,
            ],
            [
                'title' => 'The Hobbit',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'hobbit.jpg',
                'author' => 'J.R.R. Tolkien',
                'price' => 3.99,
                'categories_id' => 4,
                'user_id' => 1,
            ],
            [
                'title' => 'The Lord of the Rings',
                'description' => 'A fantasy novel by J.R.R. Tolkien',
                'image' => 'lord.jpg',
                'author' => 'J.R.R. Tolkien',
                'price' => 2.99,
                'categories_id' => 4,
                'user_id' => 1,
            ],

            [
                'title' => 'The Alchemist',
                'description' => 'A novel by Paulo Coelho',
                'image' => 'alchimest.jpg',
                'author' => 'Paulo Coelho',
                'price' => 1.99,
                'categories_id' => 5,
                'user_id' => 1,
            ],
            [
                'title' => 'The Da Vinci Code',
                'description' => 'A mystery thriller by Dan Brown',
                'image' => 'davinci.jpg',
                'author' => 'Dan Brown',
                'price' => 0.99,
                'categories_id' => 5,
                'user_id' => 1,
            ],

            [
                'title' => 'The Fault in Our Stars',
                'description' => 'A novel by John Green',
                'image' => 'fault.png',
                'author' => 'John Green',
                'price' => 0.49,
                'categories_id' => 6,
                'user_id' => 1,
            ],

            [
                'title' => 'The Hunger Games',
                'description' => 'A dystopian novel by Suzanne Collins',
                'image' => 'hunger.jpg',
                'author' => 'Suzanne Collins',
                'price' => 5.29,
                'categories_id' => 2,
                'user_id' => 1,
            ],
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'description' => 'A fantasy novel by J.K. Rowling',
                'image' => 'harry.jpg',
                'author' => 'J.K. Rowling',
                'price' => 8.19,
                'categories_id' => 5,
                'user_id' => 1,
            ],
            [
                'title' => 'The Chronicles of Narnia',
                'description' => 'A fantasy series by C.S. Lewis',
                'image' => 'narnia.jpg',
                'author' => 'C.S. Lewis',
                'price' => 7.09,
                'categories_id' => 4,
                'user_id' => 1,
            ],
            [
                'title' => 'The Kite Runner',
                'description' => 'A novel by Khaled Hosseini',
                'image' => 'kite.jpg',
                'author' => 'Khaled Hosseini',
                'price' => 4.05,
                'categories_id' => 3,
                'user_id' => 1,
            ],
            [
                'title' => 'The Book Thief',
                'description' => 'A historical novel by Markus Zusak',
                'image' => 'thief.jpg',
                'author' => 'Markus Zusak',
                'price' => 3.01,
                'categories_id' => 2,
                'user_id' => 1,
            ],

            [
                'title' => 'The Perks of Being a Wallflower',
                'description' => 'A coming-of-age novel by Stephen Chbosky',
                'image' => 'perks.jpeg',
                'author' => 'Stephen Chbosky',
                'price' => 2.99,
                'categories_id' => 1,
                'user_id' => 1,
            ],
            [
                'title' => 'The Maze Runner',
                'description' => 'A dystopian novel by James Dashner',
                'image' => 'maze.webp',
                'author' => 'James Dashner',
                'price' => 0.99,
                'categories_id' => 5,
                'user_id' => 1,
            ],
            [
                'title' => 'Divergent',
                'description' => 'A dystopian novel by Veronica Roth',
                'image' => 'Divergent.jpg',
                'author' => 'Veronica Roth',
                'price' => 0.49,
                'categories_id' => 4,
                'user_id' => 1,
            ],
        ];
        foreach ($books as $book) {
            books::create($book);
        }
    }
}