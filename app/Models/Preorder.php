<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    use HasFactory;
    protected $with = ['products'];

    protected $casts = [
        'is_urgent' => 'boolean'
    ];

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }

    public function deliver(){
        return $this->hasMany(Logistic::class);
    }
    public function saleReturn(){
        return $this->hasMany((SaleReturn::class));
    }


}
