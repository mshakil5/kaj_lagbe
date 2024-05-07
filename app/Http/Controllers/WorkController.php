<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function index()
    {
        $data = Work::orderby('id','DESC')->get();
        return view('admin.work.index', compact('data'));
    }
    
    public function new()
    {
        $data = Work::orderby('id','DESC')->where('status','1')->get();
        return view('admin.work.new', compact('data'));
    }

    public function processing()
    {
        $data = Work::orderby('id','DESC')->where('status','2')->get();
        return view('admin.work.processing', compact('data'));
    }

    public function complete()
    {
        $data = Work::with('invoice')->orderby('id','DESC')->where('status','3')->get();
        // dd($data);
        return view('admin.work.complete', compact('data'));
    }

    public function cancel()
    {
        $data = Work::orderby('id','DESC')->where('status','4')->get();
        return view('admin.work.cancel', compact('data'));
    }

    public function workGallery($id)
    {
        $data = WorkImage::where('work_id', $id)->orderby('id','DESC')->get();
        return view('admin.work.gallery', compact('data'));
    }

    public function userWorks()
    {
        $userId = auth()->id();
        $works = Work::where('user_id', $userId)->orWhere('email', Auth::user()->email)->orderBy('id', 'DESC')->get();
        return view('user.works', compact('works'));
    }

    public function showTransactions(Work $work)
    {
        $transactions = $work->transactions;
        return view('user.transactions', compact('transactions', 'work'));
    }

    public function workDetailsByAdmin($id)
    {
        $work = Work::where('id', $id)->first();
        return view('admin.work.work_details', compact('work'));
    }

    public function workDetails($id)
    {
        $work = Work::with('workimage')->where('id', $id)->first();
        return view('user.work_details', compact('work'));
    }

    public function showDetails($id)
    {
        $work = Work::with('workimage')->where('id', $id)->first();
        return view('user.show_work_details', compact('work'));
    }

    public function workUpdate(Request $request)
    {
        $imgdesc = $request->descriptions;
        $images = $request->images;
        
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'address_first_line' => ['required'],
            'post_code' => ['required'],
            'town' => ['required'],
            'phone' => ['required'],
            'images.*' => ['image'],
            'descriptions.*' => ['nullable', 'string'],
        ]);

        $work = Work::where('id', $request->workid)->first();
        
        $work->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'town' => $request->town,
            'address_first_line' => $request->address_first_line,
            'address_second_line' => $request->address_second_line,
            'address_third_line' => $request->address_third_line,
        ]);

        foreach ($imgdesc as $key => $item)
        {
            if(isset($workimageid[$key])){

                dd($images[$key]);
                $workImg = WorkImage::find($workimageid[$key]);
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    $rand = mt_rand(100000, 999999);
                    $imageName = time() . $rand . '.' . $files[$key]->extension();
                    $files[$key]->move(public_path('images'), $imageName);
                    $workImg->name = $imageName;
                }
                $workImg->description = $descriptions[$key] ?? null;
                $workImg->save();

            }else{

                $workImg = new WorkImage();
                if ($request->hasFile('images')) {
                    $files = $request->file('images');
                    $rand = mt_rand(100000, 999999);
                    $imageName = time() . $rand . '.' . $files[$key]->extension();
                    $files[$key]->move(public_path('images'), $imageName);
                    $workImg->name = $imageName;
                }
                $workImg->work_id = $work->id;
                $workImg->description = $descriptions[$key] ?? null;
                $workImg->save();
            }
        }
        return redirect()->route("user.works")->with("message", "Updated Successfully");
    }

    public function destroy($id)
    {
        Work::where('id', $id)->delete();
        return redirect()->route('user.works')->with('success', 'Work deleted successfully.');
    }

    public function changeClientStatus(Request $request)
    {
        $work = Work::find($request->id);

        if ($work->status == 3) {
            $message = "Status cannot be changed as it is already completed.";
            return response()->json(['status' => 303, 'message' => $message]);
        }

        $work->status = $request->status;

        if ($work->save()) {
            if ($work->status == 1) {
                $stsval = "New";
            } elseif ($work->status == 2) {
                $stsval = "In Progress";
            } elseif ($work->status == 3) {
                $stsval = "Completed";
            } elseif ($work->status == 4) {
                $stsval = "Cancelled";
            }

            $message = "Status Change Successfully.";
            return response()->json(['status' => 300, 'message' => $message, 'stsval' => $stsval, 'id' => $request->id]);
        } else {
            $message = "There was an error to change status!!.";
            return response()->json(['status' => 303, 'message' => $message]);
        }
    }

}
