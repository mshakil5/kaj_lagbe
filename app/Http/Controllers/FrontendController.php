<?php

namespace App\Http\Controllers;

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


        $array['name'] = $request->name;
        $array['subject'] = $request->subject;
        $array['email'] = $request->email;
        $array['message'] = $request->message;
        $array['from'] = 'do-not-reply@diamondsinn.co.uk';
        $email = "diamondsvillayork@gmail.com";

        Mail::send('email.contact', compact('array'), function($message)use($array,$email) {
                $message->from($array['from'], 'diamondsinn.co.uk');
                $message->to($email)->subject($array['subject']);
               });
        return redirect()->route("homepage")->with("message", "Mail send successfull!");

    }




}
