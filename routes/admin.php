<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TransactionController;


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
  
    
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end

    Route::get('/new-admin', [AdminController::class, 'getAdmin'])->name('alladmin');
    Route::post('/new-admin', [AdminController::class, 'adminStore']);
    Route::get('/new-admin/{id}/edit', [AdminController::class, 'adminEdit']);
    Route::post('/new-admin-update', [AdminController::class, 'adminUpdate']);
    Route::get('/new-admin/{id}', [AdminController::class, 'adminDelete']);

    Route::get('/get-all-work', [WorkController::class, 'index'])->name('admin.work');
    Route::get('/get-new', [WorkController::class, 'new'])->name('admin.new');
    Route::get('/get-processing', [WorkController::class, 'processing'])->name('admin.processing');
    Route::get('/get-complete', [WorkController::class, 'complete'])->name('admin.complete');
    Route::get('/get-cancel', [WorkController::class, 'cancel'])->name('admin.cancel');

    Route::get('/get-all-work/{id}', [WorkController::class, 'workGallery'])->name('admin.workGallery');
    Route::get('/work/{id}', [WorkController::class, 'workDetailsByAdmin'])->name('admin.work.details');

    Route::get('/all-transaction', [TransactionController::class, 'allTransactions'])->name('allTransactions');

    Route::get('/work/transaction/{id}', [TransactionController::class, 'showTransactions'])->name('work.transactions');
    Route::get('/add/transaction/{work_id}', [TransactionController::class, 'addTransaction'])->name('add.transaction');
    Route::post('/store/transaction', [TransactionController::class, 'storeTransaction'])->name('store.transaction');
    Route::get('/transaction/edit/{id}', [TransactionController::class, 'editTransaction'])->name('transaction.edit');
    Route::put('/transaction/update/{id}', [TransactionController::class, 'updateTransaction'])->name('transaction.update');
    Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');


    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit']);
    Route::post('/transactions-update', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

    Route::get('/change-client-status', [WorkController::class, 'changeClientStatus']);

    // location
    Route::get('/location', [LocationController::class, 'index'])->name('admin.location');
    Route::post('/location', [LocationController::class, 'store']);
    Route::get('/location/{id}/edit', [LocationController::class, 'edit']);
    Route::post('/location-update', [LocationController::class, 'update']);
    Route::get('/location/{id}', [LocationController::class, 'delete']);

    //Invoice
    Route::get('/invoice/{id}', [InvoiceController::class, 'index'])->name('work.invoice');
    Route::get('/invoices/create/{work_id}', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/admin/invoices/{work_id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/admin/invoices/{work_id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

    //User crud by Admin
    Route::get('/new-user', [UserController::class, 'getUser'])->name('allUser');
    Route::post('/new-user', [UserController::class, 'userStore']);
    Route::get('/new-user/{id}/edit', [UserController::class, 'userEdit']);
    Route::post('/new-user-update', [UserController::class, 'userUpdate']);
    Route::get('/new-user/{id}', [UserController::class, 'userDelete']);


    Route::get('/user-delete-request', [UserController::class, 'getUserDeleteRequest'])->name('allUserDeleteReq');

});
  