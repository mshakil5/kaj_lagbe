<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $data = Work::orderby('id','DESC')->get();
        return view('admin.work.index', compact('data'));
    }
}
