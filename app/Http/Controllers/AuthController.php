<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function Register (Request $request){

        $fieds = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:8'
        ]);

        $user = User::create($fieds);

        $token = $user->createToken($request->name);

        return ['user' => $user, 'plainTextToken' => $token->plainTextToken];
    }
    public function Login (Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){

            return response()->json(["message" => "The provided Credential are invalid"], 401);
            // return [
            //     "message" => "The provided Credential are invalid"
            // ];
        }
         $token = $user->createToken($user->name);
        return['user' => $user, 'plainTextToken'=>$token->plainTextToken];
    }
    public function Logout (Request $request){
        $request->user()->tokens()->delete();
       

        return ['message' => 'You are logged out'];
    }
}
