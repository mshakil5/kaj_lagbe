<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function editProfile()
    {
        $data = User::where('id', Auth::user()->id)->first();
        $success['data'] = $data;
        return response()->json(['success'=>true,'response'=> $success], 200);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|string|same:password',
            'phone' => 'required|regex:/^\d{11}$/',
            'address_first_line' => 'required|string|max:255',
            'address_second_line' => 'nullable|string|max:255',
            'address_third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'phone.regex' => 'The phone number must be exactly 11 digits.',
            'email.unique' => 'The email has already been taken.'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $validator->errors()], 422);
        }

        $user = User::find($request->user()->id);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => 'Current password is incorrect.'], 401);
            }

            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $oldImagePath = public_path('images/staff/' . $user->photo);

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/staff'), $imageName);
            $user->photo = $imageName;
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address_first_line = $request->address_first_line;
        $user->address_second_line = $request->address_second_line;
        $user->town = $request->town;
        $user->postcode = $request->postcode;

        $user->save();

        return response()->json(['message' => 'Profile updated successfully.', 'user' => $user], 200);
    }
}
