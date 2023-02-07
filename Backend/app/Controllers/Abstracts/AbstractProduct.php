<?php

namespace App\Controllers\Abstracts;

use App\Controllers\ProductController;

abstract class AbstractProduct
{
    abstract public function storeProduct(ProductController $product);
}
