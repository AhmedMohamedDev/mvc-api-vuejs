<?php

namespace App\Controllers\Products;

use App\Models\Product;
use App\Controllers\Abstracts\AbstractProduct;
use App\Controllers\ProductController;

class FurnitureProduct extends AbstractProduct
{
    /**
     * Store furniture product data
     *
     * @param ProductController $product
     * @return void
     */
    public function storeProduct(ProductController $product)
    {
        $productModel = new Product;
        $productModel->sku = $product->sku;
        $productModel->name = $product->name;
        $productModel->price = $product->price;
        $productModel->type  = $product->type;
        $productModel->attributes = ['height' => $product->height, 'length' => $product->length, 'width' => $product->width];
        $productModel->save();
    }
}
