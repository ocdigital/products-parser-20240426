<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, HasUuids, Searchable, SoftDeletes;

    protected $fillable = [
        'code',
        'status',
        'imported_t',
        'url',
        'creator',
        'created_t',
        'last_modified_t',
        'product_name',
        'quantity',
        'brands',
        'categories',
        'labels',
        'cities',
        'purchase_places',
        'stores',
        'ingredients_text',
        'traces',
        'serving_size',
        'serving_quantity',
        'nutriscore_score',
        'nutriscore_grade',
        'main_category',
        'image_url',
    ];

    protected $casts = [
        'imported_t' => 'datetime',
        'created_t' => 'datetime',
        'last_modified_t' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function searchableAs()
    {
        return 'products_index';
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->status = 'trash';
            $product->save();
        });
    }

    public function shouldBeSearchable()
    {
        return ! $this->trashed();
    }
}
