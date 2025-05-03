<?php

namespace App\Repository;

use App\interface\BooksInterface;
use App\Models\books;

class bookRepository implements BooksInterface
{
    public function index()
    {
        return books::all();
    }

    public function show($id)
    {
        return books::findOrFail($id);
    }

    public function store($request)
    {
        return books::create($request->all());
    }

    public function update($request, $id)
    {
        return books::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        return books::findOrFail($id)->delete();
    }

}
