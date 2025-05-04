<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoreyRequest;
use App\interface\categoreyInterface;
use Illuminate\Http\Request;

class categoreyController extends Controller
{
    use apiResponse;

    private $categoreyRepository;

    public function __construct(categoreyInterface $categoreyRepository)
    {
        $this->categoreyRepository = $categoreyRepository;
    }

    public function index()
    {
        return $this->apiResponse($this->categoreyRepository->allCategories(), 'Categorey List');
    }

    public function store(categoreyRequest $request)
    {
        $fields = $request->validated();
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('categorey', $imageName, 'public');
        $fields['image'] = $imageName;
        return $this->apiResponse($this->categoreyRepository->createCategorey($fields), 'Categorey Created');
    }

    public function show()
    {
        return $this->apiResponse($this->categoreyRepository->showCategory(request('id')), 'Categorey fetched');
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => 'nullable|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('categorey', $imageName, 'public');
            $fields['image'] = $imageName;
        }
        return $this->apiResponse($this->categoreyRepository->updateCategory($fields, request('id')), 'Categorey Updated');
    }

    public function destroy()
    {
        return $this->apiResponse($this->categoreyRepository->deleteCategory(request('id')), 'Categorey Deleted');
    }
}
