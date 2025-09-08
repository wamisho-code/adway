<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillBoardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    
    if(isset(Auth::user()->type) && Auth::user()->type=="Billboard Owner")
        return redirect()->route('home');
    else 
        return redirect()->route('home.user');
    

});
Route::get('/home', [BillBoardController::class, "fetchBillBoard"])->name('home');
Route::get('/home/user', [BillBoardController::class, "fetchAllBillBoard"])->name('home.user');
Route::get('/signup',[AuthController::class,'signUp'])->name('signup');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/signup/register',[AuthController::class,'registerNewUser'])->name('signup.register');
Route::post('/login/loginuser',[AuthController::class,'loginUser'])->name('login.user');
Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forget-password');
Route::post('/get-new-pasword',[MailController::class,'sendEmailToUser'])->name('get-new-pass');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/contact-us-mail',[MailController::class,'sendMailToCompany'])->name("contact-us-mail");
Route::get('/billboards',[BillBoardController::class,'billboards'])->name("billboards");
Route::get('billboard-search',[BillBoardController::class,'searchBillboard'])->name('billboard.search');
Route::middleware(['web'])->group(function () {
Route::get('/addbillboard',[BillBoardController::class,'takeNewBillBoard'])->name('addBillBoard');
Route::post('/newbillboards',[BillBoardController::class,'addNewBillBoard'])->name('new.billboard');
Route::get("/profile",[AuthController::class,'profile'])->name("profile");
Route::put('/profile/update',[AuthController::class,"updateProfile"])->name("profile.update");
Route::delete("/profile/delete",[AuthController::class,"leteProfile"])->name("profile.delete");
Route::middleware('auth')->group(function () {
    Route::delete('/billboards/{id}', [BillBoardController::class, 'deleteBillBoard'])->name('billboards.delete');
    Route::put('/billboards/{id}', [BillBoardController::class,"updateBillBoard"])->name('billboards.update');
    Route::get('/billboards/{id}/edit', [BillBoardController::class, 'editForm'])->name('billboards.edit');
    Route::get('/bookingform/{id}',[BookingController::class,"bookingForm"])->name('booking.form');
    Route::post('/book',[BookingController::class,"saveBooking"])->name("book");
    Route::get('/bookings',[BookingController::class,'getBookings'])->name('bookings');
    Route::get('/booked', [BookingController::class, 'seeBooked'])->name('booked.user');
    Route::get('/booked/delete/{id}', [BookingController::class, 'deleteBooking'])->name('booked.delete');
    Route::get('/admin', [AdminController::class, 'getAllBooking'])->name('admin');
    Route::get('/admin/approved', [AdminController::class, 'getAllApprovedBooking'])->name('get-approved');
    Route::get('/admin/denied', [AdminController::class, 'getAllDeniedBooking'])->name('get-denied');
    Route::get("/admin/owners",[AdminController::class,'getAllOwners'])->name('admin-owners');
    Route::put('/admin/approve-booking/{id}',[AdminController::class,'approveBooking'])->name('approve');
    Route::put('/admin/deny-booking/{id}',[AdminController::class,'denieBooking'])->name('deny');
    Route::put('/admin/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin-user-delete');
    Route::get("/admin/advertisers", [AdminController::class, 'getAllAdvertisers'])->name('admin-advertisers');
    Route::get("/admin/billboards", [AdminController::class, 'getBillboards'])->name('admin-billboards');
    Route::get('/owner/analytics', [PaymentController::class, 'getFullStat'])->name('owner.analytics');
    Route::get('/admin-stat',[PaymentController::class,'getFullStatForSiteAdmin'])->name('admin-stat');

});
});

