<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Review;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function getReviews()
    {
        $data =  Review::latest()->get();
        return view('admin.feedback.review', compact('data'));
    }

    public function getQuotes()
    {
        $data =  Quote::latest()->get();
        return view('admin.feedback.quote', compact('data'));
    }
}
