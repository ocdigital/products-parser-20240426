<?php

namespace App\Services;

use App\Repositories\ImportHistoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ApiService
{

    public function __construct(protected ImportHistoryRepositoryInterface $importHistoryRepository)
    {
      
    }

    public function getInfoApi()
    {
        $lastImport = $this->importHistoryRepository->getLastImportHistory()->created_at;
        $memoryUsage = round(memory_get_usage() / 1024 / 1024, 2) . ' MB';
        $dbConnectionStatus = DB::connection()->getPdo() ? 'Connected' : 'Not connected';
        $executionTime = $this->executionTime().' hours';

        return [
            'last_cron' => $lastImport,
            'memory_usage' => $memoryUsage,
            'db_connection_status' => $dbConnectionStatus,
            'execution_time' => $executionTime
        ];

    }

    private function executionTime()
    {
        $initSystem = Cache::get('startup_time');
        $executionTime = round((time() - strtotime($initSystem)) / 3600, 2);

        return $executionTime;
    }
}
