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
        $lastImport = ImportHistory::latest()->first();

        if (! $lastImport) {
            return new ImportHistory();
        }

        return $lastImport;
    }
}
