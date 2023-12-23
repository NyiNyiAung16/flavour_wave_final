<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function orders(){
        return $this->belongsToMany(Preorder::class);
    }

    public function inventory(){
        return $this->hasOne(Warehouse::class);
    }

    public function details(){
        return $this->hasOne(Factory::class);
    }

    public function receipes(){
        return $this->hasMany(Receipe::class);
    }
}
