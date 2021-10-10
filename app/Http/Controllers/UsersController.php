<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                session(['email_'.$user->id => $email]);
                return response()->json([
                    'Status' => 'Session Started'
                ]);
            }
            else{
                return response()->json([
                    'Status' => 'User/Password Wrong'
                ]);
            }
        }
        else{
            return response()->json([
                'Status' => 'User not found'
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        try{
            $user->save();
            session(['email_'.$user->id => $user->email]);

            return response()->json([
                'Status' => 'User register'
            ]);
        }
        catch (QueryException $e){
            return response()->json([
                'Status' => 'User already exists'
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = User::find($request->user_id);
        session()->forget('email_'.$user->id);
        return response()->json([
            'Status' => 'Session destroyed'
        ]);
    }

    public function profile($id)
    {
        if(!Session::get('email_'.$id)){
            return 'end session';
        }
        return User::find($id);
    }

    public function posts_user($id)
    {
        if(!Session::get('email_'.$id)){
            return 'end session';
        }
        return Post::where('user_id', $id)->get();
    }
}
