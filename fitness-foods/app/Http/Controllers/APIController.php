<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

class APIController extends Controller
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getLastCronRun()
    {
        return $this->apiService->getInfoApi();
    }
}
