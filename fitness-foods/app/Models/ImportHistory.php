<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'file_name',
        'imported_t',
        'total_records',
        'time_to_import',
    ];
}
