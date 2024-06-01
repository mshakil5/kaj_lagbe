<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\WorkTime;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $staffs = User::orderby('id','DESC')->where('is_type','2')->get();
        return view('admin.work.new', compact('data','staffs'));
    }

    public function processing()
    {
        $data = Work::orderby('id','DESC')->where('status','2')->get();
        return view('admin.work.processing', compact('data'));
    }

    public function complete()
    {
        $data = Work::with('invoice')->orderby('id','DESC')->where('status','3')->get();
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

    public function workDetailsByUser($id)
    {

        $uploads = Upload::where('work_id', $id)
                     ->orderBy('id', 'desc')
                     ->get();
        return view('user.work_images', compact('uploads'));
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

    public function changeWorkStatus(Request $request)
    {
        $work = Work::find($request->id);
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

    public function assignStaff(Request $request)
    {
        $workId = $request->input('work_id');
        $staffId = $request->input('staff_id');

        $work = Work::find($workId);

        if (!$work) {
            return response()->json(['error' => 'Work item not found'], 404);
        }

        $work->assigned_to = $staffId;
        $work->status = 2;
        $work->is_new = 0;
        $work->save();

        return response()->json(['success' => 'Staff assigned successfully']);
    }

    public function getAssignedTasks()
    {
        $data = Work::with('workTimes')->orderby('id','DESC')->where('status','2')->where('assigned_to',auth()->id())->get();
        return view('staff.assigned_tasks', compact('data'));
    }

    public function getCompletedTasks()
    {
        $data = Work::with('workTimes')->orderby('id','DESC')->where('status','3')->where('assigned_to',auth()->id())->get();
        return view('staff.completed_tasks', compact('data'));
    }

    public function workDetailsByStaff($id)
    {
        $work = Work::where('id', $id)->first();
        return view('staff.work_details', compact('work'));
    }

    public function workDetailsUploadByStaff($id)
    {
        $work = Work::where('id', $id)->first();
        return view('staff.work_image', compact('work'));
    }

    public function changeWorkStatusStaff(Request $request)
    {
        $work = Work::find($request->id);

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


    public function workImageUploadByStaff(Request $request)
    {
        $image = $request->image;
        $work_id = $request->work_id;
        dd($request->all());
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:20480', // 20MB Max
        ]);

        // $workImg = WorkImage::find($workimageid[$key]);
        // if ($request->hasFile('images')) {
        //     $files = $request->file('images');
        //     $rand = mt_rand(100000, 999999);
        //     $imageName = time() . $rand . '.' . $files[$key]->extension();
        //     $files[$key]->move(public_path('images'), $imageName);
        //     $workImg->name = $imageName;
        // }
        // $workImg->description = $descriptions[$key] ?? null;
        // $workImg->save();
        return back()->with("message", "Updated Successfully");
    }

    public function uploadPage($id) 
    {
        $uploads = Upload::where('work_id', $id)
                     ->orderBy('id', 'desc')
                     ->get();
        return view('staff.upload_image', compact('id', 'uploads'));
    }

    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:10240',
            'video' => 'nullable|mimes:mp4,mov|max:102400',
            'work_id' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 422, 'errors' => $errors], 422);
        }

        $workId = $request->get('work_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalExtension();
            $imagePath = 'images/completed_tasks/images/'. $imageName;
            $image->move(public_path('images/completed_tasks/images'), $imageName);
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time(). '.'. $video->getClientOriginalExtension();
            $videoPath = 'images/completed_tasks/videos/'. $videoName;
            $video->move(public_path('images/completed_tasks/videos'), $videoName);
        }

        $upload = new Upload;
        $upload->work_id = $workId;
        $upload->staff_id = auth()->user()->id;
        $upload->image = $imagePath;
        $upload->video = $videoPath;
        $upload->created_by = auth()->user()->id;
        $upload->save();

        return response()->json(['status' => 200, 'message' => 'Uploaded Successfully.']);
    }

    public function deleteFile($id)
    {
        $upload = Upload::find($id);

        if (!$upload) {
            return response()->json(['error' => 'Upload not found'], 404);
        }

        if ($upload->image && file_exists(public_path($upload->image))) {
            unlink(public_path($upload->image));
        }

        if ($upload->video && file_exists(public_path($upload->video))) {
            unlink(public_path($upload->video));
        }

        $upload->delete();

        return response()->json(['success' => 'Upload deleted successfully'], 200);
    }

    public function viewImage($id) 
    {
        $uploads = Upload::where('work_id', $id)
                     ->orderBy('id', 'desc')
                     ->get();
        return view('admin.work.completed_image', compact('uploads'));
    }

}
