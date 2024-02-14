<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    use HasFactory;

    public function preorder(){
        return $this->belongsTo(Preorder::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
