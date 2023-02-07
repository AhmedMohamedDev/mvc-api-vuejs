<?php

namespace App\Controllers\Factories;

use App\Controllers\ProductController;

class ProductFactory
{

    /**
     * Store the Product instance in the property
     *
     * @param ProductController $product
     */
    protected $product;

    public function __construct(ProductController $product)
    {
        $this->product = $product;
    }

    /**
     * Create product object based on product type
     * @param string $productType Type of product
     * @throws \RuntimeException when the incorrect product type is given
     * @return void
     */
    public function createProduct($productType)
    {
        // Create class name by concatenating namespace and uppercasing first letter of product type
        $className = "App\\Controllers\\Products\\" . ucfirst($productType) . "Product";

        // If class does not exist, throw an exception
        if (!class_exists($className)) {
            throw new \RuntimeException('Incorrect Product type');
        }

        // Create an instance of class and call storeProduct method
        return (new $className)->storeProduct($this->product);
    }
}
