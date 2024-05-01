<?php

namespace App\Http\Controllers;

/**
 * @OA\Tag(
 *     name="API Info",
 *     description="Dados sobre o sitema de API"
 * )
 */

use App\Services\ApiService;

class APIController extends Controller
{
    public function __construct(protected ApiService $apiService)
    {

    }

    /**
     * @OA\Get(
     *     path="/api/v1",
     *     tags={"API Info"},
     *     summary="Retorna informações sobre a API",
     *     security={{"apiKey":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     */
    public function __invoke()
    {
        return $this->apiService->getInfoApi();
    }
}
