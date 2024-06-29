<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function getjob()
    {
        $data = Work::where('created_by', Auth::user()->id)->orderby('id','DESC')->get();
        return view('admin.work.create', compact('data'));
    }

}
