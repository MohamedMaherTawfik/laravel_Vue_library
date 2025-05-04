<?php

namespace App\Repository;

use App\interface\BooksInterface;
use App\Models\books;

class bookRepository implements BooksInterface
{
    public function allBooks()
    {
        return books::all();
    }

    public function singleBook($id)
    {
        return books::findOrFail($id);
    }

    public function createBook($request)
    {
        return books::create($request->all());
    }

    public function updateBook($request, $id)
    {
        return books::findOrFail($id)->update($request->all());
    }

    public function deleteBook($id)
    {
        return books::findOrFail($id)->delete();
    }

}
