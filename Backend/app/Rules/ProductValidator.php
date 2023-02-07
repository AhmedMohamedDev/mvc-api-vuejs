<?php

namespace App\Rules;

use App\Core\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductValidator
{

    public function validate($data)
    {
        Validator::extend('unique_sku', function ($attribute, $value, $parameters, $validator) {
            return !Product::where('sku', $value)->exists();
        });

        $validator = Validator::make($data, [
            'sku' => 'required|string|unique_sku',
            'name' => 'required|string',
            'price' => 'required|numeric|between:0,9999.99',
            'productType' => 'required|in:dvd,book,furniture',
            'size' => 'nullable|required_if:productType,dvd|numeric|between:0,9999.99',
            'weight' => 'nullable|required_if:productType,book|numeric|between:0,9999.99',
            'height' => 'nullable|required_if:productType,furniture|numeric|between:0,9999.99',
            'length' => 'nullable|required_if:productType,furniture|numeric|between:0,9999.99',
            'width' => 'nullable|required_if:productType,furniture|numeric|between:0,9999.99',
        ], [
            'sku.required'   => 'The sku field is required.',
            'name.required'  => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'productType.required' => 'The product type field is required.',
            'size.required_if'   => 'The size field is required when product type is dvd.',
            'weight.required_if' => 'The weight field is required when product type is book.',
            'height.required_if' => 'The height field is required when product type is furniture.',
            'length.required_if' => 'The length field is required when product type is furniture.',
            'width.required_if'  => 'The width field is required when product type is furniture.',
            'size.numeric'   => 'The size field must be a number.',
            'weight.numeric' => 'The weight field must be a number.',
            'height.numeric' => 'The height field must be a number.',
            'length.numeric' => 'The length field must be a number.',
            'width.numeric'  => 'The width field must be a number.',
            'price.numeric'  => 'The price field must be a number.',
            'sku.unique_sku' => 'The sku field must be uniqe'
        ]);

        if ($validator->fails()) {
            return JsonResponse::send(['errors' => $validator->errors()], 400);
        }
    }
}
