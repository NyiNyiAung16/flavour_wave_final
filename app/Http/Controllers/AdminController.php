<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        return Inertia::render('AdminDepartment/Index',[
            'user' => auth()->user(),
            'users' => User::where('isAdmin',true)->latest()->get(),
            'departments' => Department::latest()->get()
        ]);
    }

    public function showEditPage(User $user){
        return Inertia::render('AdminDepartment/EditUser',[
            'user' => $user->load('department'),
            'departments' => Department::latest()->get()
        ]);
    }

    public function store(AdminStoreRequest $request){
        $cleanData = $request->validated();
        $cleanData['isAdmin'] = true;
        User::create($cleanData);
    }

    public function storeEditData(User $user,Request $request){
        $cleanData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department_id' =>[ 'required',Rule::exists('departments','id')],
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
