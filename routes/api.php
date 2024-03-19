<?php
if (App::environment('production')) {
    URL::forceScheme('https');
}


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\PassportAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/check-post-code', [FrontendController::class, 'checkPostCode']);
// Route::post('/work-store', [FrontendController::class, 'workStore']);

    Route::get('users-details', [UserController::class, 'index']);
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->group(function () {
//     Route::get('users', [UserController::class, 'index']);
//     Route::get('users/{id}', [UserController::class, 'show']);
// });


Route::group(['middleware' => ['auth:api']], function () {
    Route::put('password-change',[PassportAuthController::class, 'changePassword']);
    Route::post('logout',[PassportAuthController::class, 'logout']);
    Route::get('users-details', [UserController::class, 'index']);
    Route::post('user/profile/update', [UserController::class, 'userProfileUpdate']);
    Route::get('additional-addresses', [UserController::class, 'address']);
    Route::post('additional-addresses', [UserController::class, 'store']);
    Route::put('additional-addresses/{id}', [UserController::class, 'update']);
    Route::delete('additional-addresses/{id}', [UserController::class, 'destroy']);
    Route::get('works', [WorkController::class, 'userWorks']);
    Route::get('works/{id}', [WorkController::class, 'workDetails']);
    Route::post('work', [FrontendController::class, 'workStore']);
});

// Route::post('work', [FrontendController::class, 'workStore']);
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
