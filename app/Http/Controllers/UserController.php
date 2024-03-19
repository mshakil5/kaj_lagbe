<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdditionalAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userProfile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'house_number' => 'nullable|string|max:50',
            'street_name' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
        ]);

        $user->update($validatedData);
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    public function password()
    {
        return view('user.password');
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|different:current_password',
                'confirm_password' => 'required|string|same:new_password',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                throw new Exception('The current password is incorrect.');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $addresses = AdditionalAddress::where('user_id', auth()->user()->id)->get();
        return view('user.additional_addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('user.additional_addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_line' => 'required|string|max:255',
            'second_line' => 'nullable|string|max:255',
            'third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:255',
        ]);

        $address = new AdditionalAddress([
            'first_line' => $request->get('first_line'),
            'second_line' => $request->get('second_line'),
            'third_line' => $request->get('third_line'),
            'town' => $request->get('town'),
            'post_code' => $request->get('post_code'),
            'user_id' => auth()->user()->id,
        ]);

        $address->save();
        return redirect()->route('additional-addresses.index')->with('success', 'Address created successfully.');
    }

    public function edit($id)
    {
        $address = AdditionalAddress::where('id', $id)->first();
        return view('user.additional_addresses.edit', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_line' => 'required|string|max:255',
            'second_line' => 'nullable|string|max:255',
            'third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:255',
        ]);

        $address = AdditionalAddress::where('id', $id)->first();
        if (!$address) {
            return redirect()->route('additional-addresses.index')->with('error', 'Address not found.');
        }
        $address->update($request->all());
        return redirect()->route('additional-addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        AdditionalAddress::where('id', $id)->delete();
        return redirect()->route('additional-addresses.index')->with('success', 'Address deleted successfully.');
    }

}
