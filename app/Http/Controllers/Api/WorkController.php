<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function userWorks(Request $request)
    {
        $data = Work::orderBy('id', 'DESC')->get();

        return response()->json(['works' => $data], 200);
    }

    public function workDetails($id)
    {
        $work = Work::with('workimage')->where('id', $id)->first();

        if (!$work) {
            return response()->json(['message' => 'Work not found.'], 404);
        }

        return response()->json(['work' => $work], 200);
    }


}
