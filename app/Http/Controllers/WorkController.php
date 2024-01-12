<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $data = Work::orderby('id','DESC')->get();
        return view('admin.work.index', compact('data'));
    }

    public function workGallery($id)
    {
        $data = WorkImage::where('work_id', $id)->orderby('id','DESC')->get();
        return view('admin.work.gallery', compact('data'));
    }
}
