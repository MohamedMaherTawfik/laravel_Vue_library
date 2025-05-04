<?php

namespace App\Http\Controllers\api\books;

use App\Http\Controllers\web\books\apiResponse;
use App\Http\Controllers\Controller;
use App\interface\borrowsInterface;

class borrowController extends Controller
{
    use apiResponse;

    private $borrowsRepository;

    public function __construct(borrowsInterface $borrowsRepository)
    {
        $this->borrowsRepository = $borrowsRepository;
    }

    public function allBooks()
    {
        return $this->apiResponse($this->borrowsRepository->allBorrows());
    }

    public function showBorrow()
    {
        return $this->apiResponse($this->borrowsRepository->singleBorrow(request('id')));
    }

    public function storeBorrow()
    {
        return $this->apiResponse($this->borrowsRepository->store(request('id')));
    }

    public function destroyBorrow()
    {
        return $this->apiResponse($this->borrowsRepository->destroy(request('id')));
    }


}
