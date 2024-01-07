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

    public function showEditPage(User $user){
        return Inertia::render('AdminDepartment/EditUser',compact('user'));
    }

    public function store(AdminStoreRequest $request){
        $cleanData = $request->validated();
        $cleanData['isAdmin'] = true;
        $cleanData['user_id'] = 'fw - ' . fake()->randomNumber(5,true);
        $url = $cleanData['image_url']->store('profile');
        $cleanData['image_url'] = 'storage/' . $url;
        User::create($cleanData);
    }

    public function storeEditData(User $user,Request $request){
        $cleanData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image_url' => ['required','image'],
            'department' => 'required',
        ]);
        $user->update($cleanData);
    }

    public function destroy(User $user){
        $user->delete();
        return back()->with('message',[
            'content' => 'Delete user is successful.',
            'type' => 'success'
        ]);
    }
}
