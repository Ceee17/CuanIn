<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesDetail extends Model
{
    use HasFactory;

    protected $table = 'purchases_detail';
    protected $primaryKey = 'purchases_detail_id';
    protected $guarded = [];

    public function produk()
    {
        return $this->hasOne(Products::class, 'product_id', 'product_id');
    }
}
