<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipe extends Model
{
    use HasFactory;
    protected $with = ['ingredient'];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
