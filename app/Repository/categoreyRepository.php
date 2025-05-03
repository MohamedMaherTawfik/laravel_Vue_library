<?php

namespace App\Repository;

use App\Models\categories;
use App\interface\categoreyInterface;

class CategoreyRepository implements categoreyInterface
{
    public function index()
    {
        return categories::all();
    }

    public function show($id)
    {
        return categories::find($id);
    }

    public function store($request)
    {
        return categories::create($request->all());
    }

    public function update($request, $id)
    {
        return categories::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        return categories::find($id)->delete();
    }
}
