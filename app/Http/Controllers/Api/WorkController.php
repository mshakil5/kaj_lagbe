<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function userWorks(Request $request)
    {
        $userId = $request->user()->id;
        $data = Work::with('transactions','invoice','workimage')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        
        if ($data) {
            $success['data'] = $data;
            return response()->json(['success'=>true,'response'=> $success], 200);
        } else {
            $success['data'] = "No data found";
            return response()->json(['success'=>false,'response'=> $success], 202);
        }
    }

    public function workDetails($id, Request $request)
    {
        $work = Work::with('transactions','invoice','workimage')->where('id', $id)->first();
        if ($work && $work->user_id == $request->user()->id) {
            $success['data'] = $work;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
             $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }
    
    }

    public function showInvoiceApi($id, Request $request)
    {
        $work = Work::findOrFail($id);
        if ($work->user_id != $request->user()->id) {
            return response()->json(['success' => false, 'response' => ['Message' => 'No data found.']], 202);
        }
        $invoice = $work->invoice;

        if ($invoice) {
            $success['data'] = $invoice;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
            $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }  
    }

    public function showTransactionsApi($id, Request $request)
    {
        $work = Work::findOrFail($id);
        if ($work->user_id != $request->user()->id) {
            return response()->json(['success' => false, 'response' => ['Message' => 'No data found.']], 202);
        }
        $transactions = $work->transactions;
        if ($transactions){
            $success['data'] = $transactions;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
            $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }
        
    }

}
