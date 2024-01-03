<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Models\Preorder;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        return Inertia::render('AdminDepartment/Index',[
            'user' => auth()->user(),
            'users' => User::where('isAdmin',true)->latest()->get()
        ]);
    }

    public function store(AdminStoreRequest $request){
        $cleanData = $request->validated();
        $cleanData['isAdmin'] = true;
        $cleanData['user_id'] = 'fw - ' . fake()->randomNumber(5,true);
        $url = $cleanData['image_url']->store('profile');
        $cleanData['image_url'] = 'storage/' . $url;
        User::create($cleanData);
    }
}
