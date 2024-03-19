<?php

namespace App\Http\Controllers;

use mt;
use Mail;
use Exception;
use App\Models\Work;
use App\Models\Contact;
use App\Models\Location;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;

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
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'name' => ['required', 'string'],
                'address_first_line' => ['required'],
                'post_code' => ['required'],
                'town' => ['required'],
                'phone' => ['required'],
                'images.*' => ['required', 'image'],
                'descriptions.*' => ['nullable', 'string'],
            ]);

            $data = new Work();
            $data->user_id = auth()->id();
            $data->date = date('Y-m-d');
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->post_code = $request->post_code;
            $data->town = $request->town;
            $data->orderid = mt_rand(100000, 999999);
            $data->address_first_line = $request->address_first_line;
            $data->address_second_line = $request->address_second_line;
            $data->address_third_line = $request->address_third_line;
            $data->save();

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

            return redirect()->route("homepage")->with("success", "Thank you for telling us about your work");
        } catch (Exception $e) {
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
