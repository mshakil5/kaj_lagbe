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
use App\Mail\JobOrderMail;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyDetails;
use App\Models\Review;
use App\Models\Quote;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $companyDetails = CompanyDetails::first();
        return view('frontend.index', compact('categories', 'companyDetails'));
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
        
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'category_id' => ['required'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
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
        $data->category_id = $request->category_id;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->town = $request->town;
        $data->post_code = $request->post_code;
        $data->created_by = Auth::id();
        $data->save();

        $categoryName = $data->category->name;

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
        $array['category_name'] = $categoryName;
        
        Mail::to($contactmail)
        ->send(new JobOrderMail($array));

        Mail::to($ccEmails)
        ->send(new JobOrderMail($array));
        
        return redirect()->back()->with("success", "Thank you for telling us about your work");
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
        $contactmail = $request->contactemail;
        $ccEmails = $adminmail;
        $msg = $request->contactmessage; 

        if (isset($msg)) {
            $array['firstname'] = $request->firstname; 
            $array['lastname'] = $request->lastname; 
            $array['email'] = $request->contactemail;
            $array['subject'] = "Order Booking Confirmation";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

            Mail::to($ccEmails)
                ->send(new ContactMessageMail($array));
                
                
            Mail::to($adminmail)
                ->send(new ContactMessageMail($array));

            return redirect()->route("homepage")->with("message", "Message sent successfully!");
        } else {
            return redirect()->route("homepage")->with("error", "Server Error!");
        }
    }

    public function showCategoryDetails($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $companyDetails = CompanyDetails::first();
        return view('frontend.post_job', compact('category', 'companyDetails'));
    }

    public function aboutUs()
    {
        $aboutUs = CompanyDetails::select('about_us')->first()->about_us;
        return view('frontend.about_us', compact('aboutUs'));
    }

    public function review()
    {
        return view('frontend.review');
    }

    public function reviewStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'stars' => 'required|integer|min:1|max:5',
            'review' => 'required'
        ]);

        Review::create($validated);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function showRequestQuoteForm()
    {
        return view('frontend.quote_request');
    }

    public function requestQuote(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'details' => 'required|string',
        ]);
        
        Quote::create($validatedData);

        return redirect()->back()->with('success', 'Your quote request has been submitted successfully!');
    }

}
