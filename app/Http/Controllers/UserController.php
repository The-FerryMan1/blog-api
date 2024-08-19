<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function updateUser(Request $request){
        $fields = $request->validate([
             'name' => '|max:255|unique:users',
             'email'=>'|max:255|email|unique:users'
        ]);
        $currentUser = $request->user();
        $currentUser->update($fields);
        return ['message' => 'Updated successfully', 'user'=> $currentUser];
    }

    public function updateUserPassword(Request $request){
        $request->validate([
            'old_password' =>'required',
            'new_password' => 'required|confirmed|min:8'
        ]);

        $currentUser = $request->user();
        if(!$currentUser || !Hash::check($request->old_password, $currentUser->password)){
            return response()->json(['message' => 'Wrong password'],422);
        }
        $currentUser->password = Hash::make($request->new_password);
        $currentUser->save();
        return ['message' => 'Password updated successfully', 'user' => $currentUser];
    }
}
