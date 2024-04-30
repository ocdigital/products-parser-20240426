<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @return void
     */
    public function created(Product $product)
    {
        $product->searchable();
    }

    /**
     * Handle the Product "updated" event.
     *
     * @return void
     */
    public function updated(Product $product)
    {
        $product->searchable();
    }


    /**
     * Handle the Product "restored" event.
     *
     * @return void
     */
    public function restored(Product $product)
    {
        $product->searchable();
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $product->unsearchable();
    }
}
