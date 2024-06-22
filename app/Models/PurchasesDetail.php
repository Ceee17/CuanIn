<?php

namespace App\Models;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class PurchasesDetail extends Model
{
    use HasFactory;

    protected $table = 'purchases_detail';
    protected $primaryKey = 'purchases_detail_id';
    protected $guarded = [];

    public function products()
    {
        return $this->hasOne(Products::class, 'product_id', 'product_id');
    }
}
