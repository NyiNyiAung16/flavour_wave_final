<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $cast=[
        'isFree' => 'boolean'
    ];

    public function logistic(){
        return $this->hasOne(Logistic::class);
    }
}
