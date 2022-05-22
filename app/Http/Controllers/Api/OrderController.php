<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use Helper;
use Illuminate\Database\Eloquent\Builder;


class OrderController extends Controller
{

    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function order(SearchRequest $request)
    {
        $input = $request->validated();

        $data = $this->orderRepository->order($input);

        return Helper::sendResponse('OK', $data, 200);
    }

    public function product(SearchRequest $request)
    {
        $input = $request->validated();

        $data = $this->orderRepository->product($input);

        return Helper::sendResponse('OK', $data, 200);
    }

    public function list(SearchRequest $request)
    {
        $input = $request->validated();

        $data = $this->orderRepository->list($input);

        return Helper::sendResponse('OK', $data, 200);
    }

}
