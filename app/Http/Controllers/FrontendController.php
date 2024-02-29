<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Location;
use App\Models\Work;
use App\Models\Contact;
use Mail;
use App\Models\WorkImage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function workStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['required'],
            'phone' => ['required'],
            'images' => ['required'],
            'message' => ['required'],
        ]);

        $data = new Work();
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->post_code = $request->post_code;
        $data->town = $request->town;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->message = $request->message;
        if ($data->save()) {

            if ($request->images) {
                $files = $request->images;
                
                foreach ($files as $image) {
                    // dd($image);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$image->extension();
                    $image->move(public_path('images'), $imageName);
                    $workImg = new WorkImage();
                    $workImg->work_id = $data->id;
                    $workImg->name = $imageName;
                    $workImg->save();

                }
                
                return redirect()->route("homepage")->with("message", "Thank you for telling us about your work");
            }


        } else {
            return redirect()->route("homepage")->with("error", "Server Error!");
        }
        

    }


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


    public function contactMessage(Request $request)
    {
        $request->validate([
            'contactemail' => ['required', 'email'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'contactmessage' => ['required'],
        ], [
            'firstname.required' => 'First Name field is required.',
            'lastname.required' => 'Last Name field is required.',
            'contactmessage.required' => 'Message field is required.',
            'contactemail.required' => 'Email field is required.'
        ]);

        $adminmail = Contact::where('id', 1)->first()->email;
        // dd($adminmail);
        $contactmail = $request->contactmail; 
        $ccEmails = $adminmail;
        $msg = $request->contactmessage; 
                  
        if (isset($msg)) {
            $array['firstname'] = $request->firstname; 
            $array['lastname'] = $request->lastname; 
            $array['email'] = $request->contactmail; 
            $array['subject'] = "Order Booking Confirmation";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

            Mail::to($contactmail)
                ->cc($ccEmails)
                ->send(new ContactMessageMail($array));

        return redirect()->route("homepage")->with("message", "Message send successfully!");

        }else{
            return redirect()->route("homepage")->with("error", "Server Error!");
        }

    }




}
