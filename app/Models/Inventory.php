<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inventory) {
            $inventory->sku = 'SKU_' . uniqid();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
