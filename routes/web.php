<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\GetAjaxRequestController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServicePriceController;
use App\Http\Controllers\StaffController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('login', 'postLogin');
    Route::get('logout', 'logout');
});

Route::middleware(['adminCheck'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('register_user', 'postRegistration');
        Route::get('dashboard', 'adminHome')->name('dashboard');
        Route::get('users', 'usersList')->name('users');
        Route::get('delete_user/{id}', 'deleteUser');
        Route::get('user_profile', 'userProfile')->name('user_profile');
        Route::post('store_profile', 'profileStore');
    });
    
    Route::controller(DropdownController::class)->group(function () {
        Route::get('dropdowns', 'index')->name('dropdowns');
        Route::post('store_dropdown', 'store');
        Route::get('delete_dropdown/{id}', 'distroy');    
    });
    
    Route::controller(RoomTypeController::class)->group(function () {
        // Room type
        Route::get('room_types', 'index')->name('room_types');
        Route::post('store_roomtype', 'store');
        Route::get('delete_roomtype/{id}', 'destroy');   
        
        // Gallery
        Route::get('setup_image', 'galleryIndex')->name('setup_image');
        Route::post('store_image', 'galleryStore');
        Route::get('delete_image/{id}', 'galleryDestroy');   
    });
    
    Route::controller(RoomController::class)->group(function () {
        Route::get('rooms', 'index')->name('rooms');
        Route::post('store_room', 'store');
        Route::get('delete_room/{id}', 'destroy');    
    });
    
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index')->name('customers');
        Route::post('store_customer', 'store');
        Route::get('delete_customer/{id}', 'destroy');    
    });
    
    Route::controller(ServicePriceController::class)->group(function () {
        Route::get('prices', 'index')->name('prices');
        Route::post('store_price', 'store');   
    });

    Route::controller(StaffController::class)->group(function () {
        Route::get('staff', 'index')->name('staff');
        Route::post('store_staff', 'store');
        Route::get('delete_staff/{id}', 'destroy');    
        Route::get('salary', 'salaryIndex')->name('salary');
        Route::post('store_salary', 'updateSalary');
    });

    Route::controller(PayrollController::class)->group(function () {
        Route::get('payroll', 'index')->name('payroll');
        Route::post('store_payroll', 'store');
        Route::get('view_paid_salaries/{id}', 'viewSalariesPaid')->name('view_paid_salaries');
        Route::get('delete_all_paymemt/{id}', 'destroy');    
    });

    Route::controller(LoanController::class)->group(function () {
        Route::get('loans', 'index')->name('loans');
        Route::post('store_loan', 'store');
        Route::get('delete_loan/{id}', 'destroy');    
    });

});

Route::middleware(['authCheck'])->group(function () {


    
});


Route::controller(FormRequestController::class)->group(function () {
    // Modal Create Route
    Route::get('create-modal/{id}', 'getCreateModalData');

    // Modal Edit Route
    Route::get('edit-modal/{form}/{id}', 'getEditModalData');

    // Modal view Route
    Route::get('view-modal/{form}/{id}', 'getViewModalData');

    // Modal delete Route
    Route::get('delete-modal/{data}/{id}', 'getDeleteModalData');
});

Route::controller(GetAjaxRequestController::class)->group(function () {
    Route::get('get-room', 'getRoomFromRoomType');
    Route::get('get-staff-info', 'getStaffInfo');  
});

