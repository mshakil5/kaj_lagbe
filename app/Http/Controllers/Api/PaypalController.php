<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Transaction;
use App\Mail\PaymentSuccessUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PaypalController extends Controller
{
    public function workStore(Request $request)
    {
        $request->validate([
            'work_id' => ['required'],
            'amount' => ['required'],
        ], [
            'work_id' => 'Work number missing.',
        ]);
                
        $name = Auth::user()->name;
        $phone =  Auth::user()->phone;
        $email =  Auth::user()->email;
            
        $work_id = $request->work_id;
        $amount = $request->amount;

        $paypalcommission = $amount * 2.9/100;
        $fixedFee = .30;
        $amt = $amount - $paypalcommission - $fixedFee;

        $payment = new Payment();
        $payment->user_id = Auth::user()->id;
        $payment->payment_id = $request->payment_id;
        $payment->payer_id = $request->payer_id;
        $payment->payer_email = $request->email;
        $payment->amount = $request->amount;
        $payment->currency = env('PAYPAL_CURRENCY');
        $payment->payment_status = $request->state;
        $payment->save();

        $transaction = new Transaction();
        $transaction->date = date('Y-m-d');
        $transaction->user_id = Auth::user()->id;
        $transaction->work_id = $work_id;
        $transaction->amount = $amount;
        $transaction->net_amount = $amount;
        $tranid = now()->timestamp.Auth::user()->id;
        $transaction->tranid = $tranid;
        $transaction->save();


        $invoice = Invoice::where('work_id', $work_id)->first();
        if ($invoice) {
            $invoice->status = 0;
            $invoice->save();
        }

        $adminmail = Contact::where('id', 1)->first()->email;

        $user = User::find(Auth::id());
        Mail::to($email)
            ->cc($adminmail)
            ->send(new PaymentSuccessUser($user, $payment));

        return response()->json([
                'success' => true,
                'message' => 'Payment successful.'
            ], 200);
    }
}