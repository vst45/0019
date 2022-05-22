<?php

namespace App\Repositories;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{
    public function order($input)
    {
        $orders = Order::select('id', 'amount', 'date')
            ->whereHas('products', function ($query)  use ($input) {
                $query
                    ->whereProduct($input)
                    ->whereStock($input);
            })
            ->with(['products' => function ($query)  use ($input) {
                $query
                    ->select('products.id', 'products.name', 'stock', 'delivery_date')
                    ->whereProduct($input)
                    ->whereStock($input)
                    ->sortPivot($input)
                    ->sortProduct($input);
            }])
            ->whereOrder($input)
            ->sortOrder($input)
            ->get();

        return $orders->toArray();
    }

    public function product($input)
    {
        $products = Product::select('id', 'name')
            ->whereHas('orders', function ($query) use ($input) {
                $query
                    ->whereStock($input)
                    ->whereOrder($input);
            })
            ->with(['orders' => function ($query) use ($input) {
                $query
                    ->select('orders.id', 'orders.amount', 'orders.date', 'stock', 'delivery_date')
                    ->whereStock($input)
                    ->whereOrder($input)
                    ->sortPivot($input)
                    ->sortOrder($input);
            }])
            ->whereProduct($input)
            ->sortProduct($input)
            ->get();

        return $products->toArray();
    }

    public function list($input)
    {
        $list = Order::select('orders.id', 'orders.amount', 'orders.date', 'order_product.stock', 'order_product.delivery_date', 'products.name')
            ->join('order_product', 'order_product.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_product.product_id')

            ->whereProduct($input)
            ->whereOrder($input)
            ->whereStock($input)

            ->sortPivot($input)
            ->sortOrder($input)
            ->sortProduct($input)

            ->get();

        return $list->toArray();
    }
}
