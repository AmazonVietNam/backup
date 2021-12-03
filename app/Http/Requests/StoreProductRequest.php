<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:10',
            'category_id' => 'exists:categories,id',
            'unit' => 'required',
            'weight' => 'required',
            'min_qty' => 'required',
            'unit_price' => 'required|min:4|max:11',
            'tax' => 'required|min:0',
            'discount' => 'min:0',
            'current_stock' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => translate('The product name is required.'),
            'name.min' => translate('Product name must be up to 10 characters.'),
            'category_id.exists' => translate('Directory does not exist'),
            'unit.required' => translate('Unit is required'),
            'weight.required' => translate('Weight is required'),
            'min_qty.required' => translate('Sales quantity cannot be empty'),
            'unit_price.required' => translate('Unit price cannot be left blank'),
            'unit_price.min' => translate('Unit price cannot be less than 1000'),
            'unit_price.max' => translate('Unit price cannot be greater than 100000000'),
            'tax.required' => translate('Tax is required'),
            'tax.min' => translate('Tax cannot be less than 0'), 
            'discount.min' => translate('Discount cannot be less than 0'),
            'current_stock.required' => translate('Current stock is required'),
            'description.required' => translate('Description is required'),
        ];
    }
}
