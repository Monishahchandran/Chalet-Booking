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



Route::post('/calendarlist', 'api\CalendarController@calendarlist');