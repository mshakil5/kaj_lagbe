<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload;

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
        $jobid = $work->orderid;

        if ($invoice) {
            $success['data'] = $invoice;
            $success['jobid'] = $jobid;
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
            $success['jobId'] = $work->orderid;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
            $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }
        
    }

    public function getAssignedTasks()
    {
        $tasks = Work::with('workTimes')
                     ->where('status', '2')
                     ->where('assigned_to', Auth::id())
                     ->orderBy('id', 'DESC')
                     ->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No assigned tasks found.'], 404);
        }

        return response()->json(['tasks' => $tasks], 200);
    }

    public function getCompletedTasks()
    {
        $tasks = Work::with('workTimes')
                     ->where('status', '3')
                     ->where('assigned_to', Auth::id())
                     ->orderBy('id', 'DESC')
                     ->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No completed tasks found.'], 404);
        }

        return response()->json(['tasks' => $tasks], 200);
    }

    public function workDetailsByStaff($id, Request $request)
    {
        $work = Work::with('transactions','invoice','workimage')->where('id', $id)->first();
        if ($work && $work->assigned_to == Auth::id()) {
            $success['data'] = $work;
            return response()->json(['success' => true, 'response' => $success], 200);
        }else{
             $success['Message'] = 'No data found.';
            return response()->json(['success' => false, 'response' => $success], 202);
        }
    
    }

    public function changeWorkStatusStaff(Request $request, $work_id)
    {
        $validatedData = $request->validate([
            'status' => 'required|integer|in:2,3',
        ]);

        $work = Work::find($work_id);

        if (!$work) {
            return response()->json(['error' => 'Work not found'], 404);
        }

        $work->status = $validatedData['status'];

        if ($work->save()) {
            $message = "Status changed successfully.";
            return response()->json([
                'status' => 200,
                'message' => $message,
                'work ID' => $work_id
            ], 200);
        } else {
            $message = "There was an error changing status.";
            return response()->json(['status' => 500, 'message' => $message], 500);
        }
    }

    public function completedWorkDetails($id)
    {
        $work = Work::findOrFail($id);
        
        if ($work->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'response' => [
                    'message' => 'Forbidden: You do not have access to this work.'
                ]
            ], 403);
        }

        $uploads = Upload::where('work_id', $id)->get(['image', 'video']);

        if ($uploads->isEmpty()) {
            return response()->json([
                'success' => false,
                'response' => [
                    'message' => 'No uploads found for the given work ID.',
                    'data' => []
                ]
            ], 404);
        }

        return response()->json([
            'success' => true,
            'response' => [
                'message' => 'Uploads retrieved successfully.',
                'data' => $uploads
            ]
        ], 200);
    }

}
