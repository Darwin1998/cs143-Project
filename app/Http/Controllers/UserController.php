<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->get();
      
        return view('users.index',compact('users'));
    }
    public function store()
    {
        $data = request()->validate([
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'position'=>'required',
        ]);
        $data["password"] = bcrypt($data["password"]);
        User::create($data);
        return response()->json([
            "status" => "OK"
        ]);
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => 'required|max:50,email,{$user->id}',
            'password'=>'required',
            'first_name'=>'required',
            'last_name' => 'required',
            'position'=>'required'

        ]);
        $data["password"] = bcrypt($data["password"]);
        $user->update($data);

        return response()->json([
            "status" => "OK"
        ]);
    }
}
