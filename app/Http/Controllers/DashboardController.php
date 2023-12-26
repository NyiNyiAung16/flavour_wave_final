<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard() {
        return Inertia::render('Dashboard',[
            'preorders' => Preorder::where('user_id',auth()->id())->where('is_urgent',false)->get(),
            'urgents' => Preorder::where('user_id',auth()->id())->where('is_urgent',true)->get()
        ]);
    }
}
