<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Preorder;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard() {
        return Inertia::render('Dashboard',[
            'preorders' => Preorder::where('user_id',auth()->id())->where('is_urgent',false)->get(),
            'urgents' => Preorder::where('user_id',auth()->id())->where('is_urgent',true)->get(),
            'user' => auth()->user(),
            'factories' => Factory::all()->load('product')->map(function ($item){
                return [
                    'id'=>$item->id,
                    'expected' => $item->expected,
                    'actual' => $item->actual,
                    'product_id' => $item->product['id'],
                    'product_name' => $item->product['name'],
                    'isStore' => $item->product['inventory'] ? true : false,
                    'created_at'=>$item->created_at
                ];
            }),
            'products' => Product::latest()->get(),
            'warehouses' => Warehouse::all()
        ]);
    }
}
