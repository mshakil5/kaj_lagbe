<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WorkTimeController;
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
//  cache clear
  
  
Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('aboutUs');
Route::post('/work', [FrontendController::class, 'workStore'])->name('work.store');
Route::post('/contact-message', [FrontendController::class, 'contactMessage'])->name('contactMessage');

Route::get('/category/{slug}', [FrontendController::class, 'showCategoryDetails'])->name('category.show');


Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');

Route::get('/review', [FrontendController::class, 'review'])->name('review');
Route::post('/review', [FrontendController::class, 'reviewStore'])->name('review.store');


Route::post('/check-post-code', [FrontendController::class, 'checkPostCode']);
  
// payment
Route::post('pay/{id}', [PaypalController::class, 'pay'])->name('payment');
Route::get('success', [PaypalController::class, 'success']);
Route::get('error', [PaypalController::class, 'error']);


/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){
  
    Route::get('/home', [HomeController::class, 'userDashboard'])->name('user.home');
    Route::get('/works', [WorkController::class, 'userWorks'])->name('user.works');

    Route::get('/work/{id}', [WorkController::class, 'workDetails'])->name('work.details');

    Route::get('/works/{id}', [WorkController::class, 'showDetails'])->name('show.details');

    Route::put('/works', [WorkController::class, 'workUpdate'])->name('work.update');
    Route::get('/work-images/{id}', [WorkController::class, 'workDetailsByUser'])->name('user.work.images');

    Route::delete('/work/{id}', [WorkController::class, 'destroy'])->name('work.destroy');

    Route::get('/work/{work}/invoice', [InvoiceController::class, 'showInvoice'])->name('show.invoice');

    Route::get('/work/{work}/transactions', [WorkController::class, 'showTransactions'])->name('show.transactions');



    Route::get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/password', [UserController::class, 'password'])->name('user.password');
    Route::post('/password', [UserController::class, 'updatePassword'])->name('user.update.password');


    Route::get('/additional-addresses', [UserController::class, 'index'])->name('additional-addresses.index');
    Route::get('/additional-addresses/create', [UserController::class, 'create'])->name('additional-addresses.create');
    Route::post('/additional-addresses', [UserController::class, 'store'])->name('additional-addresses.store');
    Route::get('/additional-addresses/{id}/edit', [UserController::class, 'edit'])->name('additional-addresses.edit');
    Route::put('/additional-addresses/{id}', [UserController::class, 'update'])->name('additional-addresses.update');
    Route::delete('/additional-addresses/{id}', [UserController::class, 'destroy'])->name('additional-addresses.destroy');


    
});
  

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'staff/', 'middleware' => ['auth', 'is_manager']], function(){
  
    // Dashboard
    Route::get('/home', [HomeController::class, 'staffHome'])->name('staff.home');

    // Edit profile
    Route::get('/edit-profile', [StaffController::class, 'editProfile'])->name('staff.profile.edit');
    Route::post('/update-profile', [StaffController::class, 'updateProfile']);

    // Due tasks
    Route::get('/due-tasks', [WorkController::class, 'getAssignedTasks'])->name('assigned.tasks.staff');

    // Completed tasks
    Route::get('/completed-tasks', [WorkController::class, 'getCompletedTasks'])->name('completed.tasks.staff');

    // Work details
    Route::get('/work/{id}', [WorkController::class, 'workDetailsByStaff'])->name('staff.work.details');
    Route::get('/work-gallery/{id}', [WorkController::class, 'workDetailsUploadByStaff'])->name('staff.work.images');
    Route::post('/work-gallery-upload', [WorkController::class, 'workImageUploadByStaff'])->name('staff.workimages.upload');

    // Work start, stop , Break start, stop
    Route::post('/worktime/start', [WorkTimeController::class, 'startWork'])->name('worktime.start');
    Route::post('/worktime/stop', [WorkTimeController::class, 'stopWork'])->name('worktime.stop');
    Route::post('/breaktime/start', [WorkTimeController::class, 'startBreak'])->name('worktime.startBreak');
    Route::post('/breaktime/stop', [WorkTimeController::class, 'stopBreak'])->name('worktime.stopBreak');

    Route::get('/check-break', [WorkTimeController::class, 'checkBreak'])->name('checkBreak');

    // Change status by staff
    Route::get('/change-work-status', [WorkController::class, 'changeWorkStatusStaff']);
    // Upload image of completed tasks
    Route::get('/upload/{id}', [WorkController::class, 'uploadPage'])->name('upload.page');
    Route::post('/upload-file', [WorkController::class, 'uploadFile'])->name('upload-file');
    Route::delete('/upload/{id}', [WorkController::class, 'deleteFile'])->name('upload.delete');

});
 