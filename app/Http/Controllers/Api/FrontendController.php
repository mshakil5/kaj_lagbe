<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkImage;

class FrontendController extends Controller
{
    public function checkPostCode(Request $request)
    {

        $searchdata = substr($request->postcode, 0, 3);

        $data = Location::where('postcode', 'like', '%'.$request->postcode.'%')->orWhere('postcode', 'like', '%'.$searchdata.'%')->first();

        if (isset($data) ) {
            $message ="<b style='color: green'>Available</b>";
            return response()->json(['status'=> 300,'data'=>$data,'message'=>$message]);
        } else {
            $message ="<b style='color: red'>This location is out of our service.</b>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
        
    }


    public function workStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'post_code' => ['required'],
            'house_number' => ['required'],
            'town' => ['required'],
            'street' => ['required'],
            'phone' => ['required'],
            'images' => ['required'],
        ]);

        $data = new Work();
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->post_code = $request->post_code;
        $data->town = $request->town;
        $data->house_number = $request->house_number;
        $data->street = $request->street;
        $data->message = $request->message;
        if ($data->save()) {
            
            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$image->extension();
                    $image->move(public_path('images'), $imageName);
                    
                    $workImg = new WorkImage();
                    $workImg->work_id = $data->id;
                    $workImg->name = $imageName;
                    $workImg->save();
                    $images[] = $imageName;
                }
            }
            
            $works = Work::with('workimage')->where('id', $data->id)->first();
            $message ="<b style='color: green'>Data Store Successfully..</b>";
            return response()->json(['status'=> 300,'data'=>$works,'message'=>$message]);




        } else {
            $message ="<b style='color: red'>Server Error!!</b>";
            return response()->json(['status'=> 303,'data'=>$data,'message'=>$message]);
        }
        

    }

    
}
