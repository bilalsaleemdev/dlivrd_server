<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return jsonErrorResponse(false, 400, [
                'email' => 'The provided credentials are incorrect.'
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->name = $name;

        $user->save();

        return $user;

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return jsonSuccessResponse(true, 200, [
            'logout' => "User has been logged out successfully",
        ]);
    }
}
