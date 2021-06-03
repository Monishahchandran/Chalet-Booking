<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'api\UserAuth_Controller@userRegistration');
Route::post('/login', 'api\UserAuth_Controller@userLogin');
Route::post('/resetpassword', 'api\UserAuth_Controller@resetPassword');
Route::post('/chalet_list', 'api\ChaletList_Controller@chalet_list');
Route::post('/resendotp', 'api\UserAuth_Controller@sendOtpEmail');
Route::post('/verifyemail', 'api\UserAuth_Controller@emailVerification');
Route::post('/booking', 'api\Reservation_Controller@booking');
Route::post('/searchchalet', 'api\ChaletList_Controller@searchChaletList');

Route::post('/holidaysevents', 'api\ChaletList_Controller@searchHolidays');

Route::post('/calendarlist', 'api\CalendarController@calendarlist');
Route::post('/mybooking', 'api\Reservation_Controller@mybooking_list');
Route::post('/updateprofile', 'api\UserAuth_Controller@editProfile');
Route::post('/offers', 'api\ChaletList_Controller@offers');
Route::post('/remainingpay', 'api\Reservation_Controller@remainingpaid');
Route::post('/owner_chalet', 'api\Reservation_Controller@booking_chalet');
Route::post('/accept_reject', 'api\Reservation_Controller@accept_reject');
Route::post('/agreements', 'api\Reservation_Controller@agreement');
Route::post('/view_admin', 'api\Reservation_Controller@view_admin');
Route::get('/remaining_status', 'api\Crone_Controller@remaining_status');
Route::get('/check_reward', 'api\Crone_Controller@check_reward');
