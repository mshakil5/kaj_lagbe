<?php

namespace App\Http\Controllers\Api;

use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkTimeController extends Controller
{
    public function startWork(Request $request, $work_id)
    {
        $validator = Validator::make(['work_id' => $work_id], [
            'work_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workTime = new WorkTime();
        $workTime->work_id = $work_id;
        $workTime->staff_id = auth()->id();
        $workTime->start_time = Carbon::now();
        $workTime->start_date = Carbon::today()->format('d-m-Y');
        $workTime->created_by = auth()->id();
        $workTime->save();

        return response()->json([
            'message' => 'Time started for work ID ' . $work_id,
             'work_time_id' => $workTime->id,
        ], 200);
    }

    public function stopWork(Request $request, $work_time_id)
    {

        $validator = Validator::make(['work_time_id' => $work_time_id], [
            'work_time_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workTime = WorkTime::find($work_time_id);

        if (!$workTime) {
            return response()->json(['error' => 'WorkTime not found'], 404);
        }

        $startTime = Carbon::parse($workTime->start_time);
        $endTime = Carbon::now();
        $duration = $startTime->diffInSeconds($endTime);

        $workTime->end_time = $endTime;
        $workTime->duration = $duration;
        $workTime->save();

        return response()->json(['message' => 'WorkTime stopped successfully', 'duration' => $duration], 200);
    }

    public function startBreak(Request $request)
    {

        $existingBreak = WorkTime::where('staff_id', Auth::user()->id)
                                ->whereDate('created_at', Carbon::today())
                                ->whereNotNull('start_time')
                                ->whereNull('end_time')
                                ->where('is_break', 1)      
                                ->first();

        if ($existingBreak) {
            return response()->json(['message' => 'You are already on a break.'], 409);
        }

        $chkProcessingWork = WorkTime::whereNull('end_time')
            ->where('staff_id', Auth::id())
            ->where('is_break', 0)
            ->orderBy('id', 'DESC')
            ->first();

        $workTime = new WorkTime();
        $workTime->staff_id = Auth::id();
        $workTime->start_time = Carbon::now();
        $workTime->start_date = Carbon::today()->format('d-m-Y');
        $workTime->is_break = 1;
        $workTime->created_by = Auth::id();

        if ($chkProcessingWork) {
            $workTime->work_id = $chkProcessingWork->work_id;
        }

        $workTime->save();

        return response()->json([
            'message' => 'Break started successfully',
            'workTimeId' => $workTime->id
        ], 200);
    }

    public function stopBreak(Request $request)
    {

        $workTime = WorkTime::where('staff_id', Auth::id())
                            ->whereNotNull('start_time')
                            ->whereNull('end_time')
                            ->where('is_break', 1)
                            ->latest()
                            ->first();

        if (!$workTime) {
            return response()->json([
                'success' => false,
                'message' => 'No active break found'
            ], 404);
        }

        if ($workTime->end_time !== null) {
            return response()->json([
                'success' => false,
                'message' => 'You have already stopped your break'
            ], 409);
        }

        $startTime = $workTime->start_time;
        $endTime = Carbon::now();
        $duration = $endTime->diffInSeconds($startTime);

        $workTime->end_time = $endTime;
        $workTime->duration = $duration;
        $workTime->save();

        return response()->json([
            'success' => true,
            'message' => 'Break ended successfully'
        ], 200);
    }

    public function breakTime(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $formattedToday = Carbon::createFromFormat('Y-m-d', $today)->format('d-m-Y');

        $totalBreakTime = WorkTime::where('staff_id', auth()->id())
                                    ->where('start_date', $formattedToday)
                                    ->where('is_break', 1)
                                    ->sum('duration');

        if ($totalBreakTime) {
            return response()->json([
                'status' => 200,
                'message' => 'break duration in seconds',
                'total_break_time' => $totalBreakTime,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No break duration found',
            ], 404);
        }
    }


}
