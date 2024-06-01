<?php
if (App::environment('production')) {
    URL::forceScheme('https');
}


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\CallBackController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Api\WorkTimeController;


Route::post('/check-post-code', [FrontendController::class, 'checkPostCode']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::put('password-change',[PassportAuthController::class, 'changePassword']);
    Route::post('logout',[PassportAuthController::class, 'logout']);
    Route::get('user-details', [UserController::class, 'index']);
    Route::post('user-profile-update', [UserController::class, 'userProfileUpdate']);
    Route::get('additional-addresses', [UserController::class, 'address']);
    Route::post('additional-addresses', [UserController::class, 'store']);
    Route::put('additional-addresses/{id}', [UserController::class, 'update']);
    Route::delete('additional-addresses/{id}', [UserController::class, 'destroy']);
    Route::get('works', [WorkController::class, 'userWorks']);
    Route::get('works/{id}', [WorkController::class, 'workDetails']);
    Route::post('work', [FrontendController::class, 'workStore']);
    Route::post('work/{id}', [FrontendController::class, 'workUpdate']);
    Route::delete('work/{id}', [FrontendController::class, 'deleteWork']);
    Route::get('work/invoice/{id}', [WorkController::class, 'showInvoiceApi']);
    Route::get('work/transactions/{id}', [WorkController::class, 'showTransactionsApi']);
    Route::post('call-back', [CallBackController::class, 'callBack']);
    Route::get('completed-work/{id}', [WorkController::class, 'completedWorkDetails']);
    Route::get('all-transaction', [FrontendController::class, 'getAllTransaction']);
    Route::post('paypal-payment', [PaypalController::class, 'payment']);
    Route::post('account-delete-request', [CallBackController::class, 'accountDeleteRequest']);
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'staff'], function () {
    Route::get('/edit-profile', [StaffController::class, 'editProfile']);
    Route::post('/update-profile', [StaffController::class, 'updateProfile']);

    Route::get('tasks/{id}', [WorkController::class, 'workDetailsByStaff']);

    Route::get('/due-tasks', [WorkController::class, 'getAssignedTasks']);
    Route::get('/completed-tasks', [WorkController::class, 'getCompletedTasks']);

    Route::post('/start/task/{work_id}', [WorkTimeController::class, 'startWork']);

    Route::post('/stop/task/{work_time_id}', [WorkTimeController::class, 'stopWork']);

    Route::post('/change-work-status/{work_id}', [WorkController::class, 'changeWorkStatusStaff']);

    Route::post('/start/breaktime', [WorkTimeController::class, 'startBreak']);
    Route::post('/stop/breaktime', [WorkTimeController::class, 'stopBreak']);
    
    Route::get('/break-time', [WorkTimeController::class, 'breakTime']);

});


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::get('check-available-user/{id}', [PassportAuthController::class, 'checkUser']);


