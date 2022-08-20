<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ServicePriceController;

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
        Route::get('room_types', 'index')->name('room_types');
        Route::post('store_roomtype', 'store');
        Route::get('delete_roomtype/{id}', 'destroy');    
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

