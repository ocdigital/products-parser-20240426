<?php

namespace App\Repositories;

use App\Models\ImportHistory;

interface ImportHistoryRepositoryInterface
{
    public function create(array $data): ImportHistory;

    public function getLastImportHistory(): ImportHistory;
}
