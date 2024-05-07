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
            'phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'address_first_line' => 'required|string|max:255',
            'address_second_line' => 'nullable|string|max:255',
            'address_third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
 
            ], [
                'phone.regex' => 'The phone number must be exactly 11 digits.',
                'email.unique' => 'The email has already been taken.',
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

    public function getUser()
    {
        $data = User::where('is_type', '0')->orderby('id','DESC')->get();
        return view('admin.user.index', compact('data'));
    }

    public function getUserDeleteRequest()
    {
        $data = User::whereHas('accDelRequest')->where('is_type', '0')->orderby('id','DESC')->get();
        return view('admin.user.index', compact('data'));
    }

    public function userStore(Request $request)
    {
        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->password)){            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password\" field..!</b></div>"; 
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $chkemail = User::where('email',$request->email)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $data = new User;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->is_type = "0";
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function userEdit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = User::where($where)->get()->first();
        return response()->json($info);
    }

    public function userUpdate(Request $request)
    {
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $duplicateemail = User::where('email',$request->email)->where('id','!=', $request->codeid)->first();
        if($duplicateemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $data = User::find($request->codeid);
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function userDelete($id)
    {

        if(User::destroy($id)){
            return response()->json(['success'=>true,'message'=>'User has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

}
