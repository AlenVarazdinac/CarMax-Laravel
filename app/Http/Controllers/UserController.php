<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logIn(Request $request) {
        $user = $this->validate($request, [
            'user_name' => 'required',
            'user_password' => 'required'
        ]);
        $userName = $user['user_name'];
        $userPw = $user['user_password'];
        $userData = array('user_name' => $userName, 'password' => $userPw);
        if(Auth::attempt($userData)) {
            session(['user_name' => $userName]);
            echo 'Hello';
            return redirect('carmake');
        }
        echo 'Not logged in';
        dd($userData);
    }

    public function register(Request $request) {
        // Validate values
        $this->validate($request, [
            'user_name' => 'required|unique:users|min:4',
            'user_email' => 'required|unique:users',
            'user_password' => 'required|min:3'
        ]);
        // Store values from form
        $userName = $request->user_name;
        $userEmail = $request->user_email;
        $userPassword = bcrypt($request->user_password);
        // Create new user
        $user = new User();
        $user->user_name = $userName;
        $user->user_email = $userEmail;
        $user->user_password = $userPassword;
        // Save created user
        $user->save();
        // Redirect to login
        return redirect('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
