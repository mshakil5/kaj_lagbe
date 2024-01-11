<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function workStore(Request $request)
    {
        dd($request->all());

        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'post_code' => ['required'],
            'house_number' => ['required'],
            'town' => ['required'],
            'street' => ['required'],
            'phone' => ['required'],
            'images' => ['required'],
            'message' => ['required'],
        ]);

        $data = new Work();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->post_code = $request->post_code;
        $data->town = $request->town;
        $data->house_number = $request->house_number;
        $data->street = $request->street;
        $data->message = $request->message;
        if ($data->save()) {

            if ($request->hasfile('images')) {
                $files = $request->file('images');
                
                foreach ($files as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time(). $rand .'.'.$image->getClientOriginalExtension();
                    //move image to postimages folder
                    $image->move(public_path() . '/images/', $name);
                    //insert into picture table
                    $workimg = new WorkImage();
                    $workimg->work_id = $data->id;
                    $workimg->name = $name;
                    $workimg->save();
                }
                
                return redirect()->route("homepage")->with("message", "Data save successfully!");
            }


        } else {
            return redirect()->route("homepage")->with("error", "Server Error!");
        }
        

    }




}
