<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/admin', function () {return view('superadmin/sa_login');})->name('login');
Route::post('/login', 'SuperAdmin_Controller@doLogin');
Route::get('/Dashboard', 'SuperAdmin_Controller@dashboard')->name('home');
Route::get('/logout', 'SuperAdmin_Controller@doLogout')->name('logout');
Route::get('/Rejected-List', 'SuperAdmin_Controller@rejectedlist')->name('rejected_list');
Route::get('/Chalet-Agreement', 'SuperAdmin_Controller@chaletagreement')->name('chalet_agreement');
Route::get('/Chalet-Contact-Us', 'SuperAdmin_Controller@chaletcontactus')->name('chalet_contactus');
Route::get('/Settings', 'SuperAdmin_Controller@settings')->name('settings');
Route::get('/Owner', 'SuperAdmin_Controller@owner')->name('owner');
Route::get('/users', 'SuperAdmin_Controller@users')->name('users');
Route::get('/users-blocked', 'SuperAdmin_Controller@usersblocked')->name('usersblocked');
Route::get('/notifications', 'SuperAdmin_Controller@notifications')->name('notifications');
Route::get('/notifications-Auto', 'SuperAdmin_Controller@notificationsauto')->name('notificationsauto');
Route::get('/notifications-System', 'SuperAdmin_Controller@notificationssystem')->name('notificationssystem');
Route::get('/Chalet-List-All', 'SuperAdmin_Controller@chalet_listall')->name('chalet_listall');
Route::get('/Season-Prices-List', 'SuperAdmin_Controller@seasonprice_list')->name('seasonprice_list');
Route::get('/Offers', 'SuperAdmin_Controller@offers')->name('offers');
Route::get('/Holidays-and-events', 'SuperAdmin_Controller@holidayandevents')->name('holidayandevents');
Route::get('/Add-Events-To-Chalet/{id}', 'SuperAdmin_Controller@addeventstochalet')->name('addeventstochalet');
Route::get('/Chalet-Invoices-Total', 'SuperAdmin_Controller@chaletinvoicestotal')->name('chaletinvoicestotal');
Route::get('/Chalet-Invoices-Total-PAID', 'SuperAdmin_Controller@chaletinvoicestotalpaid')->name('chaletinvoicestotalpaid');
Route::get('/Chalet-Invoices-Total-UnPaid', 'SuperAdmin_Controller@chaletinvoicestotalunpaid')->name('chaletinvoicestotalunpaid');
Route::get('/Chalet-Invoices-Total-Deposits', 'SuperAdmin_Controller@chaletinvoicestotaldeposits')->name('chaletinvoicestotaldeposits');
Route::get('/Chalet-Invoices-Total-Refund-Money', 'SuperAdmin_Controller@chaletinvoicestotalrefundmoney')->name('chaletinvoicestotalrefundmoney');
Route::get('/Deposited-Money-To-Owner', 'SuperAdmin_Controller@depositedmoney_to_owner')->name('depositedmoney_to_owner');
Route::get('/add-Owner', 'SuperAdmin_Controller@addowner_view')->name('addowner_view');
Route::post('/addowner', 'SuperAdmin_Controller@addowner');
Route::get('/Chalet-add/{id}', 'SuperAdmin_Controller@addchalet_view')->name('addchalet_view');
Route::post('/addchalet', 'SuperAdmin_Controller@addchalet');
Route::post('/update_chaletstatus', 'SuperAdmin_Controller@update   _chaletstatus')->name('update_chaletstatus');
Route::post('/update_bookingstatus', 'SuperAdmin_Controller@update_bookingstatus')->name('update_bookingstatus');
Route::get('/Chalet-edit/{id}/{page}', 'SuperAdmin_Controller@editchalet_view')->name('editchalet_view');
Route::post('/updatesettings', 'SuperAdmin_Controller@updatesettings');
Route::post('/editchalet', 'SuperAdmin_Controller@update_chalet')->name('update_chalet');
Route::post('/edit_seasondate', 'SuperAdmin_Controller@edit_seasondate')->name('edit_seasondate');
Route::post('/update_seasonstatus', 'SuperAdmin_Controller@update_seasonstatus')->name('update_seasonstatus');
Route::post('/update_weeksr', 'SuperAdmin_Controller@update_weeksr')->name('update_weeksr');
Route::post('/update_weekendsr', 'SuperAdmin_Controller@update_weekendsr')->name('update_weekendsr');
Route::post('/update_weekdayssr', 'SuperAdmin_Controller@update_weekdayssr')->name('update_weekdayssr');
Route::get('/Add-new-Holidays-and-Events', 'SuperAdmin_Controller@addholidayandevent_view')->name('addholidayandevent_view');
Route::post('/addholidayandevent', 'SuperAdmin_Controller@addholidayandevent')->name('addholidayandevent');
Route::get('/Update-new-Holidays-and-Events/{id}', 'SuperAdmin_Controller@updateholidayandevent_view')->name('updateholidayandevent_view');
Route::post('/updateholidayandevent', 'SuperAdmin_Controller@updateholidayandevent')->name('updateholidayandevent');
Route::get('/deleteholidayandevent/{id}', 'SuperAdmin_Controller@deleteholidayandevent')->name('deleteholidayandevent');
Route::post('/update_holidaystatus', 'SuperAdmin_Controller@update_holidaystatus')->name('update_holidaystatus');
Route::post('/update_eventstatus', 'SuperAdmin_Controller@update_eventstatus')->name('update_eventstatus');
Route::post('/update_weeker', 'SuperAdmin_Controller@update_weeker')->name('update_weeker');
Route::post('/update_weekender', 'SuperAdmin_Controller@update_weekender')->name('update_weekender');
Route::post('/update_weekdayser', 'SuperAdmin_Controller@update_weekdayser')->name('update_weekdayser');
Route::post('/edit_eventdate', 'SuperAdmin_Controller@edit_eventdate')->name('edit_eventdate');
Route::get('/Add-new-Offers-to-Chalet', 'SuperAdmin_Controller@addoffer_view')->name('addoffer_view');
Route::post('/addoffer', 'SuperAdmin_Controller@addoffer')->name('addoffer');
Route::post('/addagreement', 'SuperAdmin_Controller@addagreement')->name('addagreement');
Route::post('/updateagreements', 'SuperAdmin_Controller@updateagreements')->name('updateagreements');
Route::get('/deleteoffers/{id}', 'SuperAdmin_Controller@deleteoffers')->name('deleteoffers');
Route::post('/update_offerprice', 'SuperAdmin_Controller@update_offerprice')->name('update_offerprice');
Route::get('/user-profile/{id}', 'SuperAdmin_Controller@userprofile')->name('userprofile');
Route::post('/update_userprofile', 'SuperAdmin_Controller@update_userprofile')->name('update_userprofile');
Route::get('/Invoice/{id}', 'SuperAdmin_Controller@invoice')->name('invoice');
Route::get('/Owner-profile/{id}', 'SuperAdmin_Controller@ownerprofile')->name('ownerprofile');
Route::post('/editowner', 'SuperAdmin_Controller@editowner')->name('editowner');
Route::get('/Chalet-List/{id}', 'SuperAdmin_Controller@owner_chaletlist')->name('owner_chaletlist');
Route::get('/Total-Reservations/{id}', 'SuperAdmin_Controller@totalreservation')->name('totalreservation');
Route::post('/send_bankdetails', 'SuperAdmin_Controller@send_bankdetails')->name('send_bankdetails');
Route::get('/TotalReservations/{cid}/{wid}', 'SuperAdmin_Controller@chaletreservation')->name('chaletreservation');
Route::get('/notifications-edit-System/{id}', 'SuperAdmin_Controller@systemnotification')->name('systemnotification');
Route::post('/update_systemnotification', 'SuperAdmin_Controller@update_systemnotification')->name('update_systemnotification');
Route::get('/Chalet-Invoices-PAID/{cid}/{wid}', 'SuperAdmin_Controller@paidreservationinvoice')->name('paidreservationinvoice');
Route::get('/Owner-Invoices-Total-PAID/{id}', 'SuperAdmin_Controller@paidchaletreservationinvoice')->name('paidchaletreservationinvoice');
Route::get('/Owner-Invoices-Total-UnPaid/{id}', 'SuperAdmin_Controller@unpaidchaletreservationinvoice')->name('unpaidchaletreservationinvoice');
Route::get('/Owner-Invoices-Total-Remaining/{id}', 'SuperAdmin_Controller@remainingchaletreservationinvoice')->name('remainingchaletreservationinvoice');
Route::get('/Chalet-Invoices-UnPaid/{cid}/{wid}', 'SuperAdmin_Controller@unpaidreservationinvoice')->name('unpaidreservationinvoice');
Route::get('/Chalet-Invoices-Remaining/{cid}/{wid}', 'SuperAdmin_Controller@remainingreservationinvoice')->name('remainingreservationinvoice');
Route::get('/deleteowner/{id}', 'SuperAdmin_Controller@deleteowner')->name('deleteowner');
Route::post('/update_refunddate', 'SuperAdmin_Controller@update_refunddate')->name('update_refunddate');
Route::post('/blockowner', 'SuperAdmin_Controller@blockowner')->name('blockowner');
Route::post('/blockuser', 'SuperAdmin_Controller@blockuser')->name('blockuser');
Route::get('/cancelreservation/{id}/{page}', 'SuperAdmin_Controller@cancelreservation')->name('cancelreservation');
Route::post('/owner_deposit', 'SuperAdmin_Controller@owner_deposit')->name('owner_deposit');




//web admin create chalet mail request
Route::get('/adminmail', function () {return view('mailWeb/index');})->name('adminmail');
Route::post('sendmail', 'Mail_Controller@sendmail')->name('sendmail');
//