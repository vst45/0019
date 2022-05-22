<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Helper;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'order_id' => 'integer',
            'date_from' => 'date_format:Y-m-d',
            'date_to' => 'date_format:Y-m-d',
            'amount_from' => 'integer',
            'amount_to' => 'integer',

            'product' => 'string',

            'stock' => 'string',
            'delivery_date_from' => 'date_format:Y-m-d',
            'delivery_date_to' => 'date_format:Y-m-d',

            'sort'    => 'array',
            'sort.*' => 'in:order_id,date,amount,stock,delivery_date,product',
            'direction'  => 'array',
            'direction.*' => 'in:asc,desc',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Helper::sendError('Помилка валідації.', $validator->errors(), 400)
        );
    }

    public function messages() //OPTIONAL
    {
        return [

            'order_id.integer' => 'Номер рахунка має бути числом',
            'date_from.date_format' => 'Формат початкової дати Y-m-d',
            'date_to.date_format' => 'Формат кінцевої дати Y-m-d',
            'amount_from.integer' => 'Мінімальна сумма замовлення - число',
            'amount_to.integer' => 'Максимальна сумма замовлення - число',

            'product.string' => 'Назва продукта - строка',

            'stock.string' => 'Назва складу - строка',
            'delivery_date_from.date_format' => 'Формат початкової дати доставки Y-m-d',
            'delivery_date_to.date_format' => 'Формат кінцевої дати доставки Y-m-d',

            'sort' => 'Невірне поле сортування',
            'direction' => 'Невірний напрямок сортування',
        ];
    }
}
