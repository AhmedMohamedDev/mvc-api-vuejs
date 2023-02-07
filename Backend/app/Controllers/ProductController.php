<?php

namespace App\Controllers;

use App\Rules\ProductValidator;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\JsonResponse;
use App\Controllers\Factories\ProductFactory;
use App\Models\Product;

class ProductController
{
    public $sku;
    public $name;
    public $price;
    public $size;
    public $weight;
    public $height;
    public $length;
    public $width;
    public $type;

    /**
     * Store product in database
     * 
     * @param ServerRequestInterface $request
     * 
     * @return JsonResponse
     */
    public function storeProduct(ServerRequestInterface $request)
    {
        $input = json_decode($request->getBody()->getContents(), true);

        $validator = new ProductValidator();
        $validator->validate($input);

        $this->sku    = htmlentities($input['sku'], ENT_QUOTES);
        $this->name   = htmlentities($input['name'], ENT_QUOTES);
        $this->price  = htmlentities($input['price'], ENT_QUOTES);
        $this->size   = htmlentities($input['size'], ENT_QUOTES);
        $this->weight = htmlentities($input['weight'], ENT_QUOTES);
        $this->height = htmlentities($input['height'], ENT_QUOTES);
        $this->length = htmlentities($input['length'], ENT_QUOTES);
        $this->width  = htmlentities($input['width'], ENT_QUOTES);
        $this->type   = htmlentities($input['productType'], ENT_QUOTES);

        $product = new ProductFactory($this);
        $product->createProduct($this->type);

        return JsonResponse::send(['message' => 'Created'], 201);
    }

    /**
     * Get all products
     * 
     * @return JsonResponse
     */
    public function all()
    {
        return jsonResponse::send(Product::all());
    }

    /**
     * Get a specific product
     * 
     * @param ServerRequestInterface $request
     * 
     * @return JsonResponse
     */
    public function show(ServerRequestInterface $request)
    {
        $input = $request->getQueryParams();
        if (!isset($input['sku'])) return JsonResponse::send(['message' => 'Product Not Found'], 404);
        $product = Product::where('sku', htmlentities($input['sku'], ENT_QUOTES))->get();
        return JsonResponse::send(['data' => $product], 200);
    }

    /**
     * Delete a specific product
     * 
     * @param ServerRequestInterface $request
     * 
     * @return JsonResponse
     */
    public function deleteProduct(ServerRequestInterface $request)
    {
        $input = file_get_contents("php://input");
        $ids = json_decode($input, true);
        Product::whereIn('id', $ids['ids'])->delete();
        return JsonResponse::send(['message' => "Posts Deleted successfully."], 200);
    }
}
