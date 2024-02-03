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
            'preorders' => Preorder::where('user_id',auth()->id())->where('is_urgent',false)->whereNull('cancel_reason')->get(),
            'urgents' => Preorder::where('user_id',auth()->id())->where('is_urgent',true)->whereNull('cancel_reason')->get(),
            'cancelOrders' => Preorder::where('user_id',auth()->id())->whereNotNull('cancel_reason')->get(),
            'user' => auth()->user()
        ]);
    }
}
