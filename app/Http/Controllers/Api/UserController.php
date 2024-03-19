<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdditionalAddress;
use App\Http\Controllers\Controller;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    

    public function index()
    {
        
        $data = User::where('id', Auth::user()->id)->first();

        $success['data'] = $data;
        return response()->json(['success'=>true,'response'=> $success], 200);
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }


    public function updateprofileImage(Request $request)
    {

        // dd($request->all());
        $userdata = Auth::user();
        $userdata->name = Auth::user()->name;
        $userdata->surname = Auth::user()->surname;
        $userdata->email = Auth::user()->email;
        $userdata->phone = Auth::user()->phone;

        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $userdata->photo = $imageName;
        }

        if ($userdata->save()) {

            $success['message'] = 'Profile Update Successfully';
            $success['data'] = $userdata;
            return response()->json(['success'=>true,'response'=> $success], 200);
        }
        else{
            
            $success['message'] = 'Server Error!!';
            return response()->json(['success'=>false,'response'=> $success], 204);
        }

    }



    public function userProfileUpdate(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'status' => 422, 
                'message' => 'Validation failed. Please check your input and try again.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update($request->all());

        return response()->json(['message' => 'Profile updated successfully!'], 200);
    }

    public function address()
    {
        $addresses = AdditionalAddress::where('user_id', Auth::user()->id)->get();

        if ($addresses->isEmpty()) {
            return response()->json(['message' => 'No additional addresses found.'], 200);
        }

        return response()->json(['addresses' => $addresses], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_line' => 'required|string|max:255',
            'second_line' => 'nullable|string|max:255',
            'third_line' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'post_code' => 'nullable|string|max:255',
        ]);

        $address = new AdditionalAddress([
            'first_line' => $validatedData['first_line'],
            'second_line' => $validatedData['second_line'],
            'third_line' => $validatedData['third_line'],
            'town' => $validatedData['town'],
            'post_code' => $validatedData['post_code'],
            'user_id' => Auth::user()->id,
        ]);

        $address->save();

        return response()->json(['message' => 'Address created successfully!', 'address' => $address], 201);
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
            return response()->json(['message' => 'Address not found.'], 404);
        }
        $address->update($request->all());

        return response()->json(['message' => 'Address updated successfully.', 'address' => $address], 200);
    }

    public function destroy($id)
    {
        $address = AdditionalAddress::where('id', $id)->first();
        if (!$address) {
            return response()->json(['message' => 'Address not found.'], 404);
        }
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully.'], 200);
    }






}
