<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait Filterable
{

    public function scopeWhereOrder($query, $input)
    {
        return $query
            ->whereOrderId($input)
            ->whereOrderDateFrom($input)
            ->whereOrderDateTo($input)
            ->whereOrderAmountFrom($input)
            ->whereOrderAmountTo($input);
    }

    public function scopeWhereOrderId($query, $input)
    {
        if (isset($input['order_id'])) {
            return $query->where('orders.id', $input['order_id']);
        }
    }

    public function scopeWhereOrderDateFrom($query, $input)
    {
        if (isset($input['date_from'])) {
            return $query->where('orders.date', '>=', $input['date_from']);
        }
    }

    public function scopeWhereOrderDateTo($query, $input)
    {
        if (isset($input['date_to'])) {
            return $query->where('orders.date', '<=', $input['date_to']);
        }
    }

    public function scopeWhereOrderAmountFrom($query, $input)
    {
        if (isset($input['amount_from'])) {
            return $query->where('orders.amount', '>=', $input['amount_from']);
        }
    }

    public function scopeWhereOrderAmountTo($query, $input)
    {
        if (isset($input['amount_to'])) {
            return $query->where('orders.amount', '<=', $input['amount_to']);
        }
    }

    public function scopeWhereProduct($query, $input)
    {
        if (isset($input['product'])) {
            return $query->where('products.name', 'like', '%' . $input['product'] . '%');
        }
    }

    public function scopeWhereStock($query, $input)
    {
        if (isset($input['stock'])) {
            return $query->where('order_product.stock', 'like', '%' . $input['stock'] . '%');
        }
    }


    public function scopeSortPivot($query, $input)
    {

        $fields = array(
            'stock' => 'stock',
            'delivery_date' => 'delivery_date',
        );

        if (isset($input['sort'])) {

            foreach ($input['sort'] as $field) {

                if (isset($fields[$field])) {
                    $query->orderBy('order_product.' . $fields[$field], Arr::get($input, 'direction.' . $field, 'asc'));
                }
            }
        }

        return $query;
    }

    public function scopeSortOrder($query, $input)
    {
        $fields = array(
            'order_id' => 'id',
            'date' => 'date',
            'amount' => 'amount'
        );

        if (isset($input['sort'])) {

            foreach ($input['sort'] as $field) {

                if (isset($fields[$field])) {
                    $query->orderBy('orders.' . $fields[$field], Arr::get($input, 'direction.' . $field, 'asc'));
                }
            }
        }

        return $query;
    }

    public function scopeSortProduct($query, $input)
    {
        $fields = array(
            'product' => 'name',
        );

        if (isset($input['sort'])) {

            foreach ($input['sort'] as $field) {

                if (isset($fields[$field])) {
                    $query->orderBy('products.' . $fields[$field], Arr::get($input, 'direction.' . $field, 'asc'));
                }
            }
        }

        return $query;
    }
}
