<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PassportAuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|regex:/^\d{11}$/',
            'address_first_line' => 'required|string|max:255',
            'address_second_line' => 'nullable|string|max:255',
            'address_third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'phone.regex' => 'The phone number must be exactly 11 digits.',
            'email.unique' => 'The email has already been taken.',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address_first_line' => $request->address_first_line,
            'address_second_line' => $request->address_second_line,
            'address_third_line' => $request->address_third_line,
            'town' => $request->town,
            'postcode' => $request->postcode,
        ]);

        $token = $user->createToken('AppName')->accessToken;
        $userId = $user;

        return response()->json(['message' => 'Registration successful.', 'token' => $token, 'userId' => $userId], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('AppName')->accessToken;
            $userId = Auth::user()->id;
            return response()->json(['message' => 'Login successful.', 'token' => $token, 'userId' => $userId], 200);
        }

        return response()->json(['message' => 'Invalid credentials.', 'error' => 'Unauthenticated'], 401);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } 
        else {
            return response()->json(['message' => 'Not authenticated'], 401);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully.'], 200);
    }

    public function checkUser($id)
    {
        $chkuser = User::where('id', $id)->first();
        
        if ($chkuser) {
            return response()->json([
                'status' => 200,
                'message' => 'User Available',
                'userdetails' => $chkuser,
            ], 200);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Inactive user or User name not found.',
            ], 200);
        }
    }

}
