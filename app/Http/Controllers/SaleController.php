<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Preorder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index(){
        return Inertia::render('SaleDepartment/Index',[
            'preorders' => Preorder::where('is_urgent',false)->get(),
            'urgents' => Preorder::where('is_urgent',true)->get(),
            'user' => auth()->user(),
            'orders' => Order::with('preorder')->latest()->get()
        ]);
    }
}
