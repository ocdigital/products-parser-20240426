<?php

namespace App\Services;

use App\Repositories\ImportHistoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ApiService
{
    private $importHistoryRepository;

    public function __construct(ImportHistoryRepositoryInterface $importHistoryRepository)
    {
        $this->importHistoryRepository = $importHistoryRepository;
    }

    public function getInfoApi()
    {
        $lastImport = $this->importHistoryRepository->getLastImportHistory()->created_at;
        $memoryUsage = memory_get_usage();
        $dbConnectionStatus = DB::connection()->getPdo() ? 'Connected' : 'Not connected';
        $executionTime = $this->executionTime();

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