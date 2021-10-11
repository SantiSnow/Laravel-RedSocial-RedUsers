<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
                session(['email_'.$user->id => $user->email]);
                session(['session_token_'.$user->id => Str::random(20)]);
                Session::put('email_'.$user->id, $user->email);
                $request->session()->put('user_id', $user->id);
                session()->save();

                return response()->json([
                    'Status' => 'Session Started',
                    'Token' => session('session_token_'.$user->id)
                ]);
            }
            else{
                return response()->json([
                    'Status' => 'User/Password Wrong',
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        try{
            $user->save();
            session(['email_'.$user->id => $user->email]);
            session(['session_token_'.$user->id => Str::random(20)]);

            return response()->json([
                'Status' => 'User registered',
                'Token' => session('session_token_'.$user->id)
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
        $user = User::where('email', $request->email)->first();
        session()->forget('email_'.$user->id);
        session()->forget('session_token_'.$user->id);
        return response()->json([
            'Status' => 'Session destroyed'
        ]);
    }

    public function profile(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(session('email_'.$user->id) == null || session('session_token_'.$user->id) == null){
            //return response()->json([
            //    'Status' => 'Session not started',
            //]);
        }
        return $user;
    }

    public function posts_user(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!Session::get('email_'.$user->id) || !Session::get('session_token_'.$user->id)){
            //return response()->json([
             //   'Status' => 'Session not started'
            //]);
        }
        return Post::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    }
}
