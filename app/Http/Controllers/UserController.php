<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    // For Login
    public function login(Request $request)
    {
        // VALIDATION
        $rules = array(
            "email" => ["required","email"],
            "password" => ["required","min:8"],
        );

        $validator = Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
            return redirect('/')->with('status', 'Wrong Credentials');
        }

        // Data Processing
        $user= User::where('email', $request->email)->first();
        
        // FOR HASH PASSWORD
        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return redirect('/')->with('status', 'Wrong Credentials');
        // }

        
        if ($user == null || !$user) {
            return redirect('/')->with('status', 'Wrong Credentials');
        }

        // FOR PLAIN TEXT PASSWORD (REPLACE THIS WITH COMMENTED HASH PASSWORD CODE ABOVE(line 31-34) IF U'RE USING HASH)
        if ($user->password != $request->password) {
            return redirect('/')->with('status', 'Wrong Credentials');
        }

        // generating session and getting user logged in
        else {
            $request->session()->put('id', $user->id);
            $request->session()->put('name', $user->name);
            $request->session()->put('email', $request->email);
            $request->session()->put('role', $user->role);
            $request->session()->put('status', $user->status);
            return redirect('/main');
        }
    }

    // For Logout
    public function logout(Request $request)
    {
        $request->session()->pull('id', 'default');
        $request->session()->pull('name', 'default');
        $request->session()->pull('email', 'default');
        $request->session()->pull('role', 'default');
        $request->session()->pull('status', 'default');
        $request->session()->flush();
        return redirect('/');
    }

    // To Block a user (ADMIN can)
    public function block($userid)
    {
            $post = User::where('id', $userid)->firstOrFail();
            $post->status = "1";
            $post->save();
            return redirect('/main');
    }
    
    // To Unblock a user (AvDMIN can)
    public function unblock($userid)
    {
            $post = User::where('id', $userid)->firstOrFail();
            $post->status = "0";
            $post->save();
            return redirect('/main');
    }
    
}
