<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use App\Models\WorkImage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class JobController extends Controller
{
    public function getjob()
    {
        $data = Work::where('created_by', Auth::user()->id)->orderby('id','DESC')->get();
        $categories = Category::where('status', 1)->get();
        return view('admin.work.create', compact('data', 'categories'));
    }

    public function jobStore(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'category_id' => ['required'],
            'town' => ['nullable'],
            'phone' => ['required', 'regex:/^\d{11}$/'],
            'images.*' => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv', 'max:102400'],
            'descriptions.*' => ['required', 'string'],
        ], [
            'phone.regex' => 'The phone number must be exactly 11 digits.',
        ]);
                
        // If validation fails, it will automatically redirect back with errors
        $data = new Work();
        $data->user_id = auth()->id();
        $data->orderid = mt_rand(100000, 999999);
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->category_id = $request->category_id;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->town = $request->town;
        $data->post_code = $request->post_code;
        $data->created_by = Auth::id();
        $data->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $descriptions = $request->input('descriptions');

            foreach ($files as $index => $image) {
                $validatedData = $request->validate([
                    'images.' . $index => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv', 'max:102400'],
                    'descriptions.' . $index => ['required', 'string'],
                ]);

                $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                $storagePath = public_path('images/works');
                $image->move($storagePath, $filename);

                $workImg = new WorkImage();
                $workImg->work_id = $data->id;
                $workImg->name = 'images/works/' . $filename;
                $workImg->description = $descriptions[$index] ?? null; 
                $workImg->save();
            }
        }
        
        
        $adminmail = Contact::where('id', 1)->first()->email;
        $contactmail = $request->email;
        $ccEmails = $adminmail;
        $msg = "Thank you for telling us about your work.";

        
        $array['firstname'] = $request->name;
        $array['email'] = $request->email;
        $array['phone'] = $request->phone;
        $array['address1'] = $request->address_first_line;
        $array['address2'] = $request->address_second_line;
        $array['address3'] = $request->address_third_line;
        $array['town'] = $request->town;
        $array['postcode'] = $request->post_code;
        $array['subject'] = "Order Booking Confirmation";
        $array['message'] = $msg;
        $array['contactmail'] = $contactmail;
        
        // Mail::to($contactmail)
        // ->send(new JobOrderMail($array));

        // Mail::to($ccEmails)
        // ->send(new JobOrderMail($array));
        
        return redirect()->back()->with("success", "New job create successfully!!");
    }


}
