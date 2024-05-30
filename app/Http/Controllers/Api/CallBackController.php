<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Models\CallBack;
use App\Models\AccDelRequest;
use App\Mail\CallbackMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class CallBackController extends Controller
{
    public function callBack(Request $request)
    {
        $callback = new CallBack();
        $callback->user_id = Auth::id();
        $callback->date = Date::now()->format('Y-m-d');

        $callback->save();

        if ($callback->exists) {

            $userData = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
                'subject' => 'Callback Request', 
            ];
            
            $adminEmail = Contact::where('id', 1)->first()->email;

            Mail::to($adminEmail)
                ->send(new CallbackMail($userData));

            return response()->json([
                'success' => true,
                'message' => 'Callback request sent successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to request a callback.'
            ], 202);
        }
    }
    
    public function accountDeleteRequest(Request $request)
    {
        $callback = new AccDelRequest();
        $callback->user_id = Auth::id();
        $callback->date = Date::now()->format('Y-m-d');
        if ($callback->save()) {

            return response()->json([
                'success' => true,
                'message' => 'Account delete request sent successfully.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to request a callback.'
            ], 202);
        }
    }
}
