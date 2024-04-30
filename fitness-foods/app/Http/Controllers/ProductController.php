<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Fitness Foods API",
 *     version="1.0.0",
 *     description="API para gerenciamento de produtos de uma loja de alimentos saudáveis",
 *     termsOfService="http://api-url/terms/",
 *
 *     @OA\Contact(
 *         email="eduardoferreira85@gmail.com",
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="apiKey",
 *     type="apiKey",
 *     in="header",
 *     name="X-Custom-API-Key",
 *     description="API key for access"
 * )
 *
 * @OA\Tag(
 *     name="Products",
 *     description="Operações relacionadas aos produtos"
 * )
 */

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {

    }


    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     tags={"Products"},
     *     summary="Retorna uma lista de produtos",
     *     security={{"apiKey":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */


    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $products = $this->productService->allPaginated($perPage);

        return new ProductCollection($products);
    }

        /**
     * @OA\Get(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Retorna um produto específico",
     *    security={{"apiKey":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     ),
     *     
     * )
     */ 
    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    /**
     * @OA\Put(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Atualiza um produto",
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),     *                 
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->all();
        return $this->productService->update($product, $data);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/products/{id}",
     *     tags={"Products"},
     *     summary="Deleta um produto",
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto deletado com sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */

    public function destroy(Product $product)
    {
        $result = $this->productService->delete($product);
        if (! $result) {
            return response()->json(['message' => 'Error deleting product'], 500);
        }

        return response()->json(['message' => 'Product deleted'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/search",
     *     tags={"Products"},
     *     summary="Busca produtos",
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */ 

    public function search(Request $request)
    {   
        $query = $request->input('query');
        $products = $this->productService->search($query);

        return new ProductCollection($products);
    }
}
