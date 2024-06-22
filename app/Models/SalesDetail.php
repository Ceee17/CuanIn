<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_detail';
    protected $primaryKey = 'sales_detail_id';
    protected $guarded = [];

    public function products()
    {
        return $this->hasOne(Products::class, 'product_id', 'product_id');
    }
}
