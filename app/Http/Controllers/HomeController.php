<?php
  
namespace App\Http\Controllers;
 
use App\Models\Work;
use App\Models\WorkTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userDashboard(): View
    {
        return view('user.dashboard');
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('admin.dashboard');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function staffHome(): View
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        $formattedToday = Carbon::createFromFormat('Y-m-d', $today)->format('d-m-Y');

        $assignedTasks = Work::where('assigned_to', $userId)
                             ->where('status', 2)
                             ->whereDate('updated_at', $today)
                             ->orderby('id','DESC')
                             ->get();

        $completedTasks = Work::where('assigned_to', $userId)
                              ->where('status', 3)
                              ->whereDate('updated_at', $today)
                              ->orderby('id','DESC')
                              ->get();

        $workDurationSum = WorkTime::where('staff_id', $userId)
                                ->where('start_date', $formattedToday)
                                ->where('is_break', 0)
                                ->sum('duration');   
                                                              
        return view('staff.dashboard', compact('assignedTasks', 'completedTasks', 'workDurationSum'));
    }

    public function index()
    {
        if (auth()->user()->is_type == '1') {
            return redirect()->route('admin.dashboard');
        }
        else if (auth()->user()->is_type == '0') {
            return redirect()->route('user.profile');
        }
        else if (auth()->user()->is_type == '2') {
            return redirect()->route('staff.profile');
        }
        else{
            return view('home');
        }
    } 
}