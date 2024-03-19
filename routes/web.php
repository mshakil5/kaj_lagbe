<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\FrontendController;
  
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
  
// Route::get('/', function () {
//     return view('welcome');
// });
  
Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/work', [FrontendController::class, 'workStore'])->name('work.store');
Route::post('/contact-message', [FrontendController::class, 'contactMessage'])->name('contactMessage');



Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');


Route::post('/check-post-code', [FrontendController::class, 'checkPostCode']);
  
// payment
Route::post('pay', [PaypalController::class, 'pay'])->name('payment');
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

    Route::put('/works', [WorkController::class, 'workUpdate'])->name('work.update');

    Route::delete('/work/{id}', [WorkController::class, 'destroy'])->name('work.destroy');

    Route::get('/work/{work}/invoice', [InvoiceController::class, 'showInvoice'])->name('show.invoice');



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
Route::group(['prefix' =>'manager/', 'middleware' => ['auth', 'is_manager']], function(){
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
 