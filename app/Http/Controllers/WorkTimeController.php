<?php

namespace App\Http\Controllers;

use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkTimeController extends Controller
{
    public function startWork(Request $request)
    {
        $workTime = new WorkTime();
        $workTime->work_id = $request->input('work_id');
        $workTime->staff_id = auth()->id();
        $workTime->start_time = Carbon::now();
        $workTime->start_date = Carbon::today()->format('d-m-Y');
        $workTime->created_by = auth()->id();
        $workTime->save();
        return response()->json(['success' => true]);
    }

    public function stopWork(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_time_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workTimeId = $request->work_time_id;
        $workTime = WorkTime::find($workTimeId);

        if (!$workTime) {
            return response()->json(['error' => 'WorkTime not found'], 404);
        }

        $startTime = Carbon::parse($workTime->start_time);
        $endTime = Carbon::now();
        $duration = $startTime->diffInSeconds($endTime);
        $workTime->end_time = $endTime;
        $workTime->duration = $duration;
        $workTime->save();
        return response()->json(['success' => true]);
    }

    public function startBreak(Request $request)
    {
        $chkProcessingWork = WorkTime::whereNull('end_time')
                                    ->where('staff_id', Auth::user()->id)
                                    ->where('is_break', 0)
                                    ->orderBy('id', 'DESC')
                                    ->first();

        $existingBreak = WorkTime::where('staff_id', Auth::user()->id)
                                ->whereDate('created_at', Carbon::today())
                                ->whereNotNull('start_time')
                                ->whereNull('end_time')
                                ->where('is_break', 1)      
                                ->first();

        if ($existingBreak) {
            return response()->json(['message' => 'You are already on a break.'], 400);
        }

        $workTime = new WorkTime();
        
        $workTime->staff_id = Auth::id();
        $workTime->start_time = Carbon::now();
        $workTime->start_date = Carbon::today()->format('d-m-Y');
        $workTime->is_break = 1;
        $workTime->created_by = Auth::id();

        if(isset($chkProcessingWork)){
            $workTime->work_id = $chkProcessingWork->work_id;
        }

        $workTime->save();
        return response()->json(['message' => 'Break started successfully', 'workTimeId' => $workTime->id], 200);
    }

    public function stopBreak(Request $request)
    {
        
        $workTime = WorkTime::find($request->work_time_id);

        if ($workTime->end_time !== null) {
            return response()->json([
                'success' => false,
                'message' => 'You have already stopped your break'
            ], 400);
        }

        if ($workTime) {
            $startTime = $workTime->start_time;
            $endTime = Carbon::now();
            $duration = $endTime->diffInSeconds($startTime);
            $workTime->end_time = $endTime;
            $workTime->duration = $duration;
            $workTime->save();
            return response()->json(['success' => true, 'message' => 'Break Out successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'WorkTime not found'], 404);
        }
    
    }

    public function checkBreak()
    {
        $existingBreak = WorkTime::where('staff_id', Auth::id())
                                ->whereDate('created_at', Carbon::today())
                                ->whereNotNull('start_time')
                                ->whereNull('end_time')
                                ->where('is_break', 1)
                                ->first();

        if ($existingBreak) {
            return response()->json([
                'in_break' => true,
                'workTimeId' => $existingBreak->id,
            ]);
        } else {
            return response()->json([
                'in_break' => false,
                'workTimeId' => null,
            ]);
        }
    }
}
