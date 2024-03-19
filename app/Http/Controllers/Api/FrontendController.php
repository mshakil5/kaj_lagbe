<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use App\Models\Location;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function checkPostCode(Request $request)
    {

        $searchdata = substr($request->postcode, 0, 3);

        $data = Location::where('postcode', 'like', '%'.$request->postcode.'%')->orWhere('postcode', 'like', '%'.$searchdata.'%')->first();

        if (isset($data) ) {
            $message ="Available";
            return response()->json(['status'=> 300,'data'=>$data,'message'=>$message]);
        } else {
            $message ="This location is out of our service.";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
        
    }


    // public function workStore(Request $request)
    // {

    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'name' => ['required', 'string'],
    //         'post_code' => ['required'],
    //         'house_number' => ['required'],
    //         'town' => ['required'],
    //         'street' => ['required'],
    //         'phone' => ['required'],
    //         'images' => ['required'],
    //         'message' => ['required'],
    //     ]);

    //     $data = new Work();
    //     $data->date = date('Y-m-d');
    //     $data->name = $request->name;
    //     $data->email = $request->email;
    //     $data->phone = $request->phone;
    //     $data->post_code = $request->post_code;
    //     $data->town = $request->town;
    //     $data->house_number = $request->house_number;
    //     $data->street = $request->street;
    //     $data->message = $request->message;
    //     if ($data->save()) {
            
    //         if ($request->hasFile('images')) {
    //             $images = [];
    //             foreach ($request->file('images') as $image) {
                    
                    
    //                 $rand = mt_rand(100000, 999999);
    //                 $imageName = time(). $rand .'.'.$image->extension();
    //                 $image->move(public_path('images'), $imageName);
                    
    //                 $workImg = new WorkImage();
    //                 $workImg->work_id = $data->id;
    //                 $workImg->name = $imageName;
    //                 $workImg->save();
    //                 $images[] = $imageName;
    //             }
    //         }
            
    //         $works = Work::with('workimage')->where('id', $data->id)->first();
    //         $message ="Data Store Successfully.";
    //         return response()->json(['status'=> 300,'data'=>$works,'message'=>$message]);




    //     } else {
    //         $message ="Server Error!!";
    //         return response()->json(['status'=> 303,'data'=>$data,'message'=>$message]);
    //     }
        

    // }




    public function workStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['required'],
            // 'phone' => ['required'],
            // 'images.*' => ['required', 'image'],
            // 'descriptions.*' => ['nullable', 'string'],
        ]);

        $data = new Work();
        $data->user_id = Auth::id();
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        // $data->phone = $request->phone;
        $data->post_code = $request->post_code;
        $data->town = $request->town;
        $data->orderid = mt_rand(100000, 999999);
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->save();

        
        // $alldata = json_decode($request->alldata, true); 

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $descriptions = $request->input('descriptions');

            foreach ($files as $index => $image) {
                $rand = mt_rand(100000, 999999);
                $imageName = time(). $rand .'.'.$image->extension();
                $image->storeAs('public/images', $imageName);

                $workImg = new WorkImage();
                $workImg->work_id = $data->id;
                $workImg->name = $imageName;
                $workImg->description = $descriptions[$index] ?? null; 
                $workImg->save();
            }
        }

        return response()->json(['message' => 'Thank you for telling us about your work. Your submission has been processed successfully.'], 201);
    }



    
}
