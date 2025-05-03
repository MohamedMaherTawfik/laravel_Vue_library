<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\bookRequest;
use App\interface\BooksInterface;
use Illuminate\Http\Request;

class bookController extends Controller
{
    use apiResponse;
    private $bookRepository;
    public function __construct(BooksInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        return $this->apiResponse($this->bookRepository->index(), 'Book List');
    }

    public function store(bookRequest $request)
    {
        $fields=$request->validated();
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('books', $imageName, 'public');
        $fields['image'] = $imageName;
        return $this->apiResponse($this->bookRepository->store($fields), 'Book Created');
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'title' => 'nullable|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|min:3',
            'author' => 'nullable|min:3',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('books', $imageName, 'public');
            $fields['image'] = $imageName;
        }
        return $this->apiResponse($this->bookRepository->update($fields, request('id')), 'Book Updated');
    }

    public function destroy()
    {
        return $this->apiResponse($this->bookRepository->destroy(request('id')), 'Book Deleted');
    }

}
