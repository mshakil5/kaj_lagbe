<?php

namespace App\Http\Controllers\Api;

use Exception;
use Mail;
use App\Models\Work;
use App\Models\Location;
use App\Models\WorkImage;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Mail\JobOrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function workStore2(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['nullable'],
            'phone' => ['required'],
            'images.*' => ['required', 'image'],
        ]);

        $data = new Work();
        $data->user_id = auth()->id();
        $data->orderid = mt_rand(100000, 999999);
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->town = $request->town;
        $data->post_code = $request->post_code;
        $data->created_by = Auth::id();
        $data->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            
            foreach ($files as $index => $image) {
                $validatedData = $request->validate([
                    'images.' . $index => ['required', 'image'],
                ]);

                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $storagePath = public_path('images/works');
                $image->move($storagePath, $filename);

                $workImg = new WorkImage();
                $workImg->work_id = $data->id;
                $workImg->name = 'images/works/' . $filename;
                $workImg->save();
            }
        }
        return response()->json(['message' => 'Work stored successfully.', 'work' => $data], 200);
    }
    
    
    public function workStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['nullable'],
            'phone' => ['required']
        ]);

        $data = new Work();
        $data->user_id = auth()->id();
        $data->orderid = mt_rand(100000, 999999);
        $data->date = date('Y-m-d');
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
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
                // $validatedData = $request->validate([
                //     'images.' . $index => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv', 'max:102400'],
                //     'descriptions.' . $index => ['required', 'string'],
                // ]);

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
        
        
        Mail::to($contactmail)
        ->send(new JobOrderMail($array));

        Mail::to($ccEmails)
        ->send(new JobOrderMail($array));
        
        return response()->json(['message' => 'Work stored successfully.', 'work' => $data], 200);
        
    }

    public function workUpdate(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['nullable'],
            'phone' => ['required'],
            // 'images.*' => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv', 'max:102400'],
            // 'descriptions.*' => ['required', 'string'],
        ]);

        $data = Work::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address_first_line = $request->address_first_line;
        $data->address_second_line = $request->address_second_line;
        $data->address_third_line = $request->address_third_line;
        $data->town = $request->town;
        $data->post_code = $request->post_code;
        $data->save();

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $descriptions = $request->input('descriptions');

            foreach ($files as $index => $image) {
                // $validatedData = $request->validate([
                //     'images.' . $index => ['required', 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv', 'max:102400'],
                //     'descriptions.' . $index => ['required', 'string'],
                // ]);

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
        return response()->json(['message' => 'Work updated successfully.', 'work' => $data], 200);
    }

    public function deleteWork($id)
    {
        $work = Work::find($id);
        if (!$work) {
            return response()->json(['message' => 'Work not found.'], 404);
        }
        if ($work->invoice()->exists()) {
            return response()->json(['message' => 'Cannot delete work. There are associated invoices.'], 422);
        }
        if ($work->delete()) {
            return response()->json(['message' => 'Work deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Error deleting work.'], 500);
        }
    }
    
    public function getAllTransaction()
    {
        $data = Transaction::where('user_id', Auth::user()->id)->get();
        $works = Work::with('transactions')->where('user_id', Auth::user()->id)->get();
        if ($data){
            $success['data'] = $data;
            $success['works'] = $works;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
            $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }
        
    }

}
