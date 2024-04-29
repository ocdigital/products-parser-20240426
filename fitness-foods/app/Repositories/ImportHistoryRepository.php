<?php

namespace App\Repositories;

use App\Models\ImportHistory;

class ImportHistoryRepository implements ImportHistoryRepositoryInterface
{
    public function create(array $data): ImportHistory
    {
        return ImportHistory::create($data);
    }

    public function getLastImportHistory(): ImportHistory
    {
        return ImportHistory::latest()->first();
    }
}