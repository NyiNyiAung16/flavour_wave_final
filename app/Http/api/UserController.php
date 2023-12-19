<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // get all Users' info
    public function show()
    {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }
    public function show_one($id)
    {
        $user = User::where('user_id', $id)->get();
        return response()->json([
            'user' => $user,
        ]);
    }
    // create User account
    public function createUser(UserRequest $request)
    {
        User::create($request->validated());
        return response()->json([
            'message' => 'Your account has successfully been created'
        ]);
    }

    // edit User account
    public function editUser($id, Request $request)
    {
        $data = $this->inputEditUserDetails($request);
        User::where('user_id', $id)->update($data);
    }
}
