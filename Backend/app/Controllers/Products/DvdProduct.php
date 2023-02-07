<?php


namespace App\Controllers\Products;

use App\Models\Product;
use App\Controllers\Abstracts\AbstractProduct;
use App\Controllers\ProductController;

class DvdProduct extends AbstractProduct
{

    /**
     * Store dvd product data
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
        $productModel->attributes = ['size' => $product->size];
        $productModel->save();
    }
}
