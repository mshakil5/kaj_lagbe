<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($id)
    {
        $work = Work::findOrFail($id);
        $data = $work->transactions;
        return view('admin.work.transactions.index', compact('data', 'work'));
    }

    public function store(Request $request)
    {
        if(empty($request->date)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Date \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        // if(empty($request->net_amount)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Net amount \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }

        if(empty($request->amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $validatedData = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            // 'net_amount' => 'required|numeric',
            'work_id' => 'required|exists:works,id', 
        ]);

        $work = Work::findOrFail($validatedData['work_id']);

        $transaction = new Transaction();
        $transaction->date = $validatedData['date'];
        $transaction->amount = $validatedData['amount'];
        // $transaction->net_amount = $validatedData['net_amount'];
        $transaction->work_id = $validatedData['work_id'];
        $transaction->user_id = $work->user_id; 

        $tranid = now()->format('Ym') . Str::random(6);
        $transaction->tranid = $tranid;

        if ($transaction->save()){
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Transaction Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        };
    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Transaction::where($where)->get()->first();
        return response()->json($info);
    }
    
    public function update(Request $request)
    {
        if(empty($request->date)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Date \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->net_amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Net amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $validatedData = $request->validate([
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric',
            'net_amount' => 'nullable|numeric',
        ]);

        $transaction = Transaction::find($request->codeid);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        $updateData = [
            'date' => $validatedData['date'],
            'amount' => $validatedData['amount'],
            'net_amount' => $validatedData['net_amount'],
        ];

        if ($transaction->update($updateData)) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);$message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } 
        else {
           return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function destroy($id)
    {
        if(Transaction::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function showTransactions($id)
    {
        $work = Work::findOrFail($id);
        $data = $work->transactions;
        return view('admin.work.transactions.index', compact('data','work'));
    }
    
    public function addTransaction($work_id)
    {
        return view('admin.work.transaction.create', compact('work_id'));
    }

        public function allTransactions()
    {
        $data = Transaction::with('work')->orderBy('id', 'desc')->get();
        return view('admin.work.transaction.list', compact('data'));
    }

}
