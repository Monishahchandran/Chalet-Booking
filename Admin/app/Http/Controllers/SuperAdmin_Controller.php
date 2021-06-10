<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hash;
use Alert;
use Illuminate\Support\Facades\File;
use App\Models\Admin;
use App\Models\Users;
use App\Models\Owner;
use App\Models\Chalet;
use App\Models\ChaletUpload;
use App\Models\ChaletDetails;
use App\Models\SeasonDate;
use App\Models\HolidayAndEvents;
use App\Models\ChaletEvent;
use App\Models\Offers;
use App\Models\Agreement;
use App\Models\Reservation;
use App\Models\SystemNotification;

use Validator, Redirect, Response;
use Image;
use App\Photo;
use Intervention\Image\Exception\NotReadableException;
use App\Helper;
use Illuminate\Support\Facades\Mail;

class SuperAdmin_Controller extends Controller
{
    public function doLogin(Request $request)
    {
        $count = Admin::select('*')->where('email', $request->username)->where('password', '=', base64_encode($request->password))->count();
        // print_r($count);die();
        if ($count == 1) {
            $user = Admin::where('email', $request->username)->where('password', '=', base64_encode($request->password))->select('*')->first();
            // print_r($user);die();
            session(['adminlog' => true]);
            // session(['admin_id' => base64_encode($user->id)]);
            // session(['admin_name' => $user->first_name . ' ' . $user->last_name]);
            return redirect()->route('home')->with('success', 'Logged In Successfully!');
        } else {
            session(['adminlog' => false]);
            return redirect()->route('login')->with('error', 'Invalid Credentials!');
        }
    }
    public function dashboard()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        // print_r(Session::get('adminlog'));
        return view('superadmin/sa_dashboard');
    }
    public function doLogout()
    {
        Session::flush();
        return redirect()->route('login')->with('error', 'Logged Out Successfully!');
    }
    public function rejectedlist()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        // print_r(Session::get('adminlog'));
        return view('superadmin/sa_rejectedlist');
    }
    public function chaletagreement()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['agreementdata'] = Agreement::select('*')->get();
        return view('superadmin/sa_chaletagreement', $data);
    }
    public function chaletcontactus()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        // print_r(Session::get('adminlog'));
        return view('superadmin/sa_chaletcontactus');
    }
    public function settings()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['admindata'] = Admin::select('*')->first();
        return view('superadmin/sa_settings', $data);
    }
    public function owner()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['ownerdetails'] = Owner::select('*')->get();
        return view('superadmin/sa_owner', $data);
    }
    public function users()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['userdetails'] = Users::select('*')->get();
        return view('superadmin/sa_users', $data);
    }
    public function usersblocked()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['userdetails'] = Users::select('*')->where('block_status','1')->get();
        return view('superadmin/sa_usersblocked',$data);
    }
    public function notifications()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        // print_r(Session::get('adminlog'));
        return view('superadmin/sa_notifications');
    }
    public function notificationsauto()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        // print_r(Session::get('adminlog'));
        return view('superadmin/sa_notificationsauto');
    }
    public function notificationssystem()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['systemnotification'] = SystemNotification::select('*')->get();
        return view('superadmin/sa_notificationssystem', $data);
    }
    public function chalet_listall()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['chaletdetails'] = Chalet::select('*', 'tb_chalet.id as cid')->join('tb_owner', 'tb_owner.id', '=', 'tb_chalet.ownerid')->get();
        // print_r($data['chaletdetails']);die();
        return view('superadmin/sa_chalet_listall', $data);
    }
    public function seasonprice_list()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['seasondate'] = SeasonDate::first();
        $data['chaletlist'] = Chalet::select('*', 'tb_chalet.id as cid')->join('tb_owner', 'tb_owner.id', '=', 'tb_chalet.ownerid')->get();
        return view('superadmin/sa_seasonprice_list', $data);
    }
    public function offers()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['chaletdetails'] = Chalet::select('*', 'tb_chalet.id as cid', 'tb_offers.id as oid')->join('tb_owner', 'tb_owner.id', '=', 'tb_chalet.ownerid')->join('tb_offers', 'tb_offers.chaletid', '=', 'tb_chalet.id')->orderBy('tb_offers.id', 'DESC')->get();
        // print_r($data['chaletdetails']);die();
        $data['admindata'] = Admin::select('*')->first();
        return view('superadmin/sa_offers', $data);
    }
    public function holidayandevents()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['holidaylist'] = HolidayAndEvents::get();
        return view('superadmin/sa_holidayandevents', $data);
    }
    public function addeventstochalet($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($id);
        $data['event'] = HolidayAndEvents::where('id', $id)->first();
        $data['chaletlist'] = Chalet::select('*', 'tb_chalet.id as cid')->join('tb_owner', 'tb_owner.id', '=', 'tb_chalet.ownerid')->get();
        // print_r($data['chaletlist']);die();
        return view('superadmin/sa_addeventstochalet', $data);
    }
    public function chaletinvoicestotal()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->get();
        // print_r($data['reservationlist']);die();
        return view('superadmin/sa_chaletinvoicestotal', $data);
    }
    public function chaletinvoicestotalpaid()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'paid')->get();
        return view('superadmin/sa_chaletinvoicestotalpaid', $data);
    }
    public function chaletinvoicestotalunpaid()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_chaletinvoicestotalunpaid', $data);
    }
    public function chaletinvoicestotaldeposits()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.deposit', '!=', '0')->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_chaletinvoicestotaldeposits', $data);
    }
    public function chaletinvoicestotalrefundmoney()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $user_id = base64_decode(Session::get('adminid'));
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.booking_status', '1')->get();
        return view('superadmin/sa_chaletinvoicestotalrefundmoney', $data);
    }
    public function depositedmoney_to_owner()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'paid')->get();
        return view('superadmin/sa_depositedmoney_to_owner', $data);
    }
    public function addowner_view()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        return view('superadmin/sa_addowner');
    }
    public function addowner(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $count = Owner::select('*')->where('email', $request->email)->count();
        if ($count == 1) {
            // return back()->with('error', 'Email Already Exist!');
            return back()->withInput();
        } else {
            if (($request->password) == ($request->cpassword)) {
                if ($request->hasFile('photo')) {
                    $pfileimg = $request->photo;
                    $pextension = $pfileimg->getClientOriginalExtension();
                    $pname = time() . rand(11111, 99999) . '.' . $pextension;
                    $pfileimg->move('uploads/profile_pic', $pname);
                    $profile_pic = $pname;
                } else {
                    $profile_pic = "";
                }
                if ($request->hasFile('civilid')) {
                    $cfileimg = $request->civilid;
                    $cextension = $cfileimg->getClientOriginalExtension();
                    $cname = time() . rand(11111, 99999) . '.' . $cextension;
                    $cfileimg->move('uploads/chalet_uploads/civilid', $cname);
                    $civil_id = $cname;
                } else {
                    $civil_id = "";
                }
                if ($request->hasFile('ownership')) {
                    $ofileimg = $request->ownership;
                    $oextension = $ofileimg->getClientOriginalExtension();
                    $oname = time() . rand(11111, 99999) . '.' . $oextension;
                    $ofileimg->move('uploads/chalet_uploads/ownership', $oname);
                    $chalet_ownership = $oname;
                } else {
                    $chalet_ownership = "";
                }
                if ($request->hasFile('agreement')) {
                    $afileimg = $request->agreement;
                    $aextension = $afileimg->getClientOriginalExtension();
                    $aname = time() . rand(11111, 99999) . '.' . $aextension;
                    $afileimg->move('uploads/chalet_uploads/agreement', $aname);
                    $agreement = $aname;
                } else {
                    $agreement = "";
                }
                Owner::insert([['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'country' => $request->country, 'phone' => $request->phone, 'gender' => $request->gender, 'profile_pic' => $profile_pic, 'civil_id' => $civil_id, 'chalet_ownership' => $chalet_ownership, 'agreement' => $agreement, 'bank_holder_name' => $request->holder_name, 'bank_name' => $request->bank_name, 'iban_num' => $request->iban_num, 'password' => base64_encode($request->password)]]);
                $last = Owner::select('id')->latest()->first();
                $user_id = $last->id;
                $email = $request->email;
                $ownerdetails = Owner::select('*')->where('id', $user_id)->first();
                //    print_r($ownerdetails);die();
                $data['owner_name'] = $ownerdetails->first_name . ' ' . $ownerdetails->last_name;
                if (!empty($ownerdetails->civil_id)) {
                    $civilid = "- CIVIL ID:" . url('uploads/chalet_uploads/civilid/') . '/' . $ownerdetails->civil_id;
                } else {
                    $civilid = "";
                }
                if (!empty($ownerdetails->chalet_ownership)) {
                    $chalet_ownership = "- Chalet ownership:" . url('uploads/chalet_uploads/ownership/') . '/' . $ownerdetails->chalet_ownership;
                } else {
                    $chalet_ownership = "";
                }
                if (!empty($ownerdetails->agreement)) {
                    $agreement = "- Agreement:" . url('uploads/chalet_uploads/agreement/') . '/' . $ownerdetails->chalet_ownership;
                } else {
                    $agreement = "";
                }
                $data = array(
                    'holder_name' => $request->holder_name,
                    'bank_name' => $request->bank_name,
                    'iban_num' => $request->iban_num,
                    'owner_name' => $ownerdetails->first_name . ' ' . $ownerdetails->last_name,
                    'civilid' => $civilid,
                    'chalet_ownership' => $chalet_ownership,
                    'agreement' => $agreement,
                    'title' => 'Welcome to Aby Chalet',
                    'email' => $request->email,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'password' => $request->password
                );
                Mail::send('ownermail', $data, function ($message) use ($email) {
                    $message->to($email)->subject('Message');
                    // $message->from('varshag.srishti@gmail.com', 'The Stock');
                });
                return redirect('/Owner')->with('success', 'Successfully Created Owner');
            } else {
                return back()->withInput()->with('error', 'Please enter matching Passwords');;
            }
        }
    }
    public function addchalet_view($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($id);
        $data['ownerdetails'] = Owner::select('*')->where('id', $id)->first();
        return view('superadmin/sa_addchalet', $data);
    }
    public function addchalet(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // print_r($request->uploadvideo);die();
        Chalet::insert([['ownerid' => $request->ownerid, 'chalet_name' => $request->chalet_name, 'location' => $request->location, 'commision' => $request->commission, 'weekday_rent' => $request->weekday_rent, 'weekend_rent' => $request->weekend_rent, 'week_rent' => $request->week_rent]]);
        $last = Chalet::select('id')->latest()->first();
        $chaletid = $last->id;


        if (!empty($request->chalet_detail)) {
            foreach ($request->chalet_detail as $ch) {
                if (!empty($ch)) {
                    ChaletDetails::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'chalet_detail' => $ch]]);
                }
            }
        }
        if ($request->hasFile('uploadvideo')) {
            foreach ($request->uploadvideo as $vfileimg) {
                $vextension = $vfileimg->getClientOriginalExtension();
                $vname = time() . rand(11111, 99999) . '.' . $vextension;
                $vfileimg->move('uploads/chalet_uploads/chalet_images', $vname);
                $chaletvideo[] = $vname;
            }
            foreach ($chaletvideo as $chalet_video) {
                ChaletUpload::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'file_name' => $chalet_video, 'file_type' => 'video']]);
            }
        }
        if ($request->hasFile('uploadphoto')) {
            foreach ($request->uploadphoto as $pfileimg) {
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/chalet_uploads/chalet_images', $pname);
                $chaletphoto[] = $pname;
            }
            foreach ($chaletphoto as $chalet_photo) {
                ChaletUpload::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'file_name' => $chalet_photo, 'file_type' => 'image']]);
            }
        }
        return redirect('/Owner')->with('success', 'Successfully Created Chalet');
    }
    public function update_chaletstatus(Request $request)
    {
        $is_activestatus = $request->is_activestatus;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('is_activestatus' => $is_activestatus));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_bookingstatus(Request $request)
    {
        $bookingstatus = $request->bookingstatus;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('auto_acceptbooking' => $bookingstatus));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function editchalet_view($id, $page)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($id);
        $data['chaletdata'] = Chalet::select('*')->where('id', $id)->first();
        $data['chaletuploads_photo'] = ChaletUpload::select('*')->where('chaletid', $id)->where('file_type', 'image')->orderBy('id', 'ASC')->get();
        $data['chaletuploads_video'] = ChaletUpload::select('*')->where('chaletid', $id)->where('file_type', 'video')->orderBy('id', 'ASC')->get();
        $data['chaletdetails'] = Chaletdetails::select('*')->where('chaletid', $id)->orderBy('id', 'ASC')->get();
        $data['page'] = base64_decode($page);
        // print_r($data['chaletuploads_video']);die();
        return view('superadmin/sa_editchalet', $data);
    }
    public function updatesettings(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $remain = $request->remaining_amt_pay;
        $deposit = $request->deposit_available;
        if ($remain > $deposit) {
            return back()->withInput()->with('error', 'Hours remaining to pay Must be Lower than Deposit available hour');
        } else {
            if (($request->adminpassword) == ($request->cadminpassword)) {
                if (!empty($request->adminpassword)) {
                    $password = base64_encode($request->adminpassword);
                } else {
                    $password = $request->old_adminpassword;
                }
                Admin::query()->update(array('email' => $request->email_admin, 'contactus_email' => $request->email_Contact, 'password' => $password, 'deposit' => $request->deposit, 'deposit_available' => $request->deposit_available, 'remaining_amt_pay' => $request->remaining_amt_pay, 'offer_expiry' => $request->offer_expiry, 'check_in' => $request->check_in, 'check_out' => $request->check_out, 'insta_url' => $request->insta_url, 'terms_url' => $request->terms_url, 'l_and_p_url' => $request->landp_url, 'shareapp_url' => $request->shareapp_url, 'invite_friend' => $request->invite_friend, 'timezone' => $request->timezone, 'reward_earn' => $request->reward_earn, 'every_spend' => $request->every_spend));
                return redirect('/Settings')->with('success', 'Successfully Updated Details');
            } else {
                return back()->withInput()->with('error', 'Please enter matching Passwords');
            }
        }
    }
    public function update_chalet(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }

        $chaletid = $request->chaletid;
        // echo $chaletid ;die();
        Chalet::where('id', $chaletid)->update(array('ownerid' => $request->ownerid, 'chalet_name' => $request->chalet_name, 'location' => $request->location, 'commision' => $request->commission, 'weekday_rent' => $request->weekday_rent, 'weekend_rent' => $request->weekend_rent, 'week_rent' => $request->week_rent));

        //new chalet detail upload
        if (!empty($request->chalet_detail)) {
            foreach ($request->chalet_detail as $ch) {
                if (!empty($ch)) {
                    ChaletDetails::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'chalet_detail' => $ch]]);
                }
            }
        }
        //end

        //updated chalet details
        // print_r($request->updated_cdid);die();
        if (!empty($request->updated_cdid)) {
            $cdetails = Chaletdetails::select('*')->where('chaletid', $chaletid)->orderBy('id', 'ASC')->get();
            foreach ($cdetails as $c) {
                $cdid[] = $c->id;
            }
            // print_r($request->chaletdetail);die();
            foreach ($request->chaletdetail as $key => $value) {
                $val = $cdid[$key];
                $cdresult[$key] = array($value, $val);
            }
            // print_r($cdresult);
            foreach ($cdresult as $chaletdetail) {
                // print_r($chalet_photo['0']);
                $detail = $chaletdetail['0'];
                $cdid = $chaletdetail['1'];
                ChaletDetails::where('id', $cdid)->update(array('chalet_detail' => $detail));
            }
        }
        //end
        // die();
        //delete chaletdetails
        $chaletupload_delete = $request->chaletdetail_id;
        if (!empty($chaletupload_delete)) {
            $deletedetailupid = explode(",", $chaletupload_delete);
            foreach ($deletedetailupid as $dcid) {
                ChaletDetails::where('id', $dcid)->delete();
            }
        }
        //end

        //delete files section
        $video_delete = $request->videochaletupload_id;
        if (!empty($video_delete)) {
            $deletevupid = explode(",", $video_delete);
            // print_r($deletevupid);die();
            foreach ($deletevupid as $did) {
                $chaletresult = ChaletUpload::where('id', $did)->first();
                $file_name = $chaletresult->file_name;
                $video_path = 'uploads/chalet_uploads/chalet_images/' . $file_name;
                if (File::exists($video_path)) {
                    File::delete($video_path);
                    // $dd =dd($dd);
                }
                ChaletUpload::where('id', $did)->delete();
            }
        }
        $photo_delete = $request->photochaletupload_id;
        if (!empty($photo_delete)) {
            $deletepupid = explode(",", $photo_delete);
            foreach ($deletepupid as $dpid) {
                $chalet_result = ChaletUpload::where('id', $dpid)->first();
                $file_name = $chalet_result->file_name;
                $image_path = 'uploads/chalet_uploads/chalet_images/' . $file_name;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                    // $dd =dd($dd);
                }
                ChaletUpload::where('id', $dpid)->delete();
            }
        }
        // die();
        //end delete file section

        //add new files
        if ($request->hasFile('upload_video')) {
            foreach ($request->upload_video as $v_fileimg) {
                $v_extension = $v_fileimg->getClientOriginalExtension();
                $vname = time() . rand(11111, 99999) . '.' . $v_extension;
                $v_fileimg->move('uploads/chalet_uploads/chalet_images', $vname);
                $newchaletvideo[] = $vname;
            }
            foreach ($newchaletvideo as $chalet_video) {
                ChaletUpload::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'file_name' => $chalet_video, 'file_type' => 'video']]);
            }
        }
        if ($request->hasFile('upload_photo')) {
            foreach ($request->upload_photo as $p_fileimg) {
                $p_extension = $p_fileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $p_extension;
                $p_fileimg->move('uploads/chalet_uploads/chalet_images', $pname);
                $newchaletphoto[] = $pname;
            }
            foreach ($newchaletphoto as $chalet_photo) {
                ChaletUpload::insert([['ownerid' => $request->ownerid, 'chaletid' => $chaletid, 'file_name' => $chalet_photo, 'file_type' => 'image']]);
            }
        }
        //end add new files

        //update file section
        if ($request->hasFile('uploadvideo')) {
            foreach ($request->uploadvideo as $vfileimg) {
                $vextension = $vfileimg->getClientOriginalExtension();
                $vname = time() . rand(11111, 99999) . '.' . $vextension;
                $vfileimg->move('uploads/chalet_uploads/chalet_images', $vname);
                $chaletvideo[] = $vname;
            }
            $upload_id = $request->updated_cvid;
            $results = array();
            $resultids = explode(",", $upload_id);
            // print_r($resultid);die();
            foreach ($chaletvideo as $key => $value) {
                $val = $resultids[$key];
                $results[$key] = array($value, $val);
            }
            // print_r($result);die();
            foreach ($results as $chalet_video) {
                // print_r($chalet_photo['0']);
                $filename = $chalet_video['0'];
                $uploadedid = $chalet_video['1'];
                $chaletresult = ChaletUpload::where('id', $uploadedid)->first();
                $oldfilename = $chaletresult->file_name;
                $photopath = 'uploads/chalet_uploads/chalet_images/' . $oldfilename;
                if (File::exists($photopath)) {
                    File::delete($photopath);
                    // $dd =dd($dd);
                }
                ChaletUpload::where('id', $uploadedid)->update(array('file_name' => $filename));
            }
            // die();
        }
        if ($request->hasFile('uploadphoto')) {
            foreach ($request->uploadphoto as $pfileimg) {
                $pextension = $pfileimg->getClientOriginalExtension();
                $pname = time() . rand(11111, 99999) . '.' . $pextension;
                $pfileimg->move('uploads/chalet_uploads/chalet_images', $pname);
                $chaletphoto[] = $pname;
            }
            $uploadid = $request->updated_cpid;
            $result = array();
            $resultid = explode(",", $uploadid);
            // print_r($resultid);die();
            foreach ($chaletphoto as $key => $value) {
                $val = $resultid[$key];
                $result[$key] = array($value, $val);
            }
            // print_r($result);die();
            foreach ($result as $chalet_photo) {
                $file_name = $chalet_photo['0'];
                $uploaded_id = $chalet_photo['1'];
                //deleting the existing file from folder
                $chaletresult = ChaletUpload::where('id', $uploaded_id)->first();
                $oldfile_name = $chaletresult->file_name;
                $photo_path = 'uploads/chalet_uploads/chalet_images/' . $oldfile_name;
                if (File::exists($photo_path)) {
                    File::delete($photo_path);
                    // $dd =dd($dd);
                }
                ChaletUpload::where('id', $uploaded_id)->update(array('file_name' => $file_name));
            }
            // die();
        }
        //end update file section
        // echo "i";die();
        // echo $request->page;die();
        if ($request->page == 'listall') {
            return redirect('/Chalet-List-All')->with('success', 'Successfully Updated Chalet');
        } else if ($request->page == 'list') {
            $wid = base64_encode($request->ownerid);
            return redirect('/Chalet-List/' . $wid)->with('success', 'Successfully Updated Chalet');
        } else if ($request->page == 'totalreservation') {
            $wid = base64_encode($request->ownerid);
            return redirect('/Total-Reservations/' . $wid)->with('success', 'Successfully Updated Chalet');
        }
    }
    public function edit_seasondate(Request $request)
    {
        $count = SeasonDate::count();
        if ($count == 0) {
            SeasonDate::insert([['season_start' => $request->season_start, 'season_end' => $request->season_end]]);
        } else {
            SeasonDate::query()->update(array('season_start' => $request->season_start, 'season_end' => $request->season_end));
        }

        return response()->json(['success' => 'Successfully Updated.']);
    }
    public function update_seasonstatus(Request $request)
    {
        $season_status = $request->season_status;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('season_status' => $season_status));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_weeksr(Request $request)
    {
        $week_seasonprice = $request->week_seasonprice;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('week_seasonprice' => $week_seasonprice));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_weekendsr(Request $request)
    {
        $weekend_seasonprice = $request->weekend_seasonprice;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('weekend_seasonprice' => $weekend_seasonprice));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_weekdayssr(Request $request)
    {
        $weekdays_seasonprice = $request->weekdays_seasonprice;
        $id = $request->chaletid;
        Chalet::where('id', $id)->update(array('weekdays_seasonprice' => $weekdays_seasonprice));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function addholidayandevent_view()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        return view('superadmin/sa_addnewholidayandevents');
    }
    public function addholidayandevent(Request $request)
    {

        HolidayAndEvents::insert([['event_name' => $request->event_name, 'check_in' => $request->event_checkin, 'check_out' => $request->event_checkout]]);
        return redirect('/Holidays-and-events')->with('success', 'Successfully Created Holiday And Events');
    }
    public function updateholidayandevent_view($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($id);
        $data['holidaydetails'] = HolidayAndEvents::select('*')->where('id', $id)->first();
        return view('superadmin/sa_updatenewholidayandevents', $data);
    }
    public function updateholidayandevent(Request $request)
    {

        HolidayAndEvents::where('id', $request->holidayid)->update(array('event_name' => $request->event_name, 'check_in' => $request->event_checkin, 'check_out' => $request->event_checkout));
        return redirect('/Holidays-and-events')->with('success', 'Successfully Created Holiday And Events');
    }
    public function deleteholidayandevent($id)
    {
        $id = base64_decode($id);
        HolidayAndEvents::where('id', $id)->delete();
        return redirect('/Holidays-and-events')->with('success', 'Successfully Deleted Holiday And Events');
    }
    public function update_holidaystatus(Request $request)
    {
        $holiday_status = $request->holiday_status;
        $id = $request->holidayid;
        HolidayAndEvents::where('id', $id)->update(array('holiday_status' => $holiday_status));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_eventstatus(Request $request)
    {
        $chaletevent_status = $request->chaletevent_status;
        $cid = $request->chaletid;
        $eid = $request->eventid;
        $count = ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->count();
        // print_r($count);
        if ($count == 0) {
            ChaletEvent::insert([['event_id' => $eid, 'chalet_id' => $cid, 'chaletevent_status' => $chaletevent_status]]);
        } else {
            ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->update(array('chaletevent_status' => $chaletevent_status));
        }
        return response()->json(['success' => 'Successfully event Changed Status.']);
    }
    public function update_weeker(Request $request)
    {
        $week_eventprice = $request->week_price;
        $cid = $request->chaletid;
        $eid = $request->eventid;
        $count = ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->count();
        // print_r($eid);
        if ($count == 0) {
            ChaletEvent::insert([['event_id' => $eid, 'chalet_id' => $cid, 'week_price' => $week_eventprice]]);
        } else {
            print_r(array('week_price' => $week_eventprice));
            ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->update(array('week_price' => $week_eventprice));
        }

        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_weekender(Request $request)
    {
        $weekend_eventprice = $request->weekend_price;
        $cid = $request->chaletid;
        $eid = $request->eventid;
        $count = ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->count();
        // print_r($eid);
        if ($count == 0) {
            ChaletEvent::insert([['event_id' => $eid, 'chalet_id' => $cid, 'week_price' => $weekend_eventprice]]);
        } else {
            ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->update(array('weekend_price' => $weekend_eventprice));
        }
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function update_weekdayser(Request $request)
    {
        $weekdays_eventprice = $request->weekdays_price;
        $cid = $request->chaletid;
        $eid = $request->eventid;
        $count = ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->count();
        if ($count == 0) {
            ChaletEvent::insert([['event_id' => $eid, 'chalet_id' => $cid, 'weekdays_price' => $weekdays_eventprice]]);
        } else {
            ChaletEvent::where('event_id', $eid)->where('chalet_id', $cid)->update(array('weekdays_price' => $weekdays_eventprice));
        }
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function edit_eventdate(Request $request)
    {
        HolidayAndEvents::where('id', $request->event_id)->update(array('check_in' => $request->event_checkin, 'check_out' => $request->event_checkout));
        return response()->json(['success' => 'Successfully Updated.']);
    }
    public function addoffer_view()
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $data['chaletdetails'] = Chalet::select('*', 'tb_chalet.id as cid')->join('tb_owner', 'tb_owner.id', '=', 'tb_chalet.ownerid')->get();
        return view('superadmin/sa_addnewoffer', $data);
    }
    public function addoffer(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $chalet_id = explode(',', $request->chalet_id);
        foreach ($chalet_id as $id) {
            // print_r($id);
            if (!empty($id)) {
                Offers::insert([['discount_amt' => $request->discount_amt, 'offer_checkin' => $request->offer_checkin, 'offer_checkout' => $request->offer_checkout, 'chaletid' => $id]]);
            }
        }
        return redirect('/Offers')->with('success', 'Successfully Added Offers Chalet');
    }
    public function addagreement(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // print_r($request->agreement);die();
        foreach ($request->agreement as $agreement) {
            if (!empty($agreement)) {
                Agreement::insert([['agreement_content' => $agreement]]);
            }
        }
        return redirect('/Chalet-Agreement')->with('success', 'Successfully Added Chalet Agreements');
    }
    public function updateagreements(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $update = explode(',', $request->agreementid);
        // print_r($update);
        if (!empty($request->agreementid)) {
            foreach ($update as $u) {
                // print_r($u);
                $agreement_update = explode('+', $u);
                // print_r($agreement_update);
                $id = $agreement_update['0'];
                $content = $agreement_update['1'];
                Agreement::where('id', $id)->update(array('agreement_content' => $content));
            }
        }
        if (!empty($request->agreement)) {
            foreach ($request->agreement as $agreement) {
                Agreement::insert([['agreement_content' => $agreement]]);
            }
        }
        if (!empty($request->deleteid)) {
            $deleteid = explode(',', $request->deleteid);
            foreach ($deleteid as $d_id) {
                Agreement::where('id', $d_id)->delete();
            }
        }
        return redirect('/Chalet-Agreement')->with('success', 'Successfully Added Chalet Agreements');
    }
    public function deleteoffers($id)
    {
        $id = base64_decode($id);
        Offers::where('id', $id)->delete();
        return redirect('/Offers')->with('success', 'Successfully Deleted Offer');
    }
    public function update_offerprice(Request $request)
    {
        $new_price = $request->new_price;
        $id = $request->id;
        Offers::where('id', $id)->update(array('discount_amt' => $new_price));
        return response()->json(['success' => 'Successfully Changed Status.']);
    }
    public function userprofile($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $data['userdetails'] = Users::select('*')->where('id', $user_id)->first();
        return view('superadmin/sa_userprofile', $data);
    }
    public function update_userprofile(Request $request)
    {
        $id = $request->userid;
        $password = base64_encode($request->password);
        // echo $password;die();
        if (!empty($password)) {
            // echo "not empty";die();
            $result = Users::where('id', $id)->update(array('first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'country' => $request->country, 'phone' => $request->phone, 'gender' => $request->gender, 'password' => $password));
            // if (!$result) {
            //     return back()->with('success', 'Profile Updated!');
            // } else {
            return back()->with('error', 'Failed!');
            // }
        } else {
            // echo " empty";die();
            $result = Users::where('id', $id)->update(array('first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'country' => $request->country, 'phone' => $request->phone, 'gender' => $request->gender));
            // if (!$result) {
            return back()->with('success', 'Profile Updated!');
            // } else {
            //     return back()->with('error', 'Failed!');
            // }
        }
    }
    public function invoice($id)
    {
        $reservationid = base64_decode($id);
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid', 'tb_reservation.created_at as createdat')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.id', $reservationid)->first();
        // print_r($data['reservationlist'] );die();
        return view('superadmin/sa_invoicepage', $data);
    }
    public function ownerprofile($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        return view('superadmin/sa_ownerprofile', $data);
    }
    public function editowner(Request $request)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        if (!empty($request->password)) {
            $password = base64_encode($request->password);
        } else {
            $password = $request->old_password;
        }
        // echo $request->ownerid;die();
        $ownerdetails = Owner::select('*')->where('id', $request->ownerid)->first();
        $email = $ownerdetails->email;
        // print_r($ownerdetails);die();
        if ($request->hasFile('photo')) {
            $pfileimg = $request->photo;
            $pextension = $pfileimg->getClientOriginalExtension();
            $pname = time() . rand(11111, 99999) . '.' . $pextension;
            $pfileimg->move('uploads/profile_pic', $pname);
            $profile_pic = $pname;
        } else {
            $profile_pic = $ownerdetails->profile_pic;
        }
        if ($request->hasFile('civilid')) {
            $cfileimg = $request->civilid;
            $cextension = $cfileimg->getClientOriginalExtension();
            $cname = time() . rand(11111, 99999) . '.' . $cextension;
            $cfileimg->move('uploads/chalet_uploads/civilid', $cname);
            $civil_id = $cname;
        } else {
            $civil_id = $ownerdetails->civil_id;
        }
        if ($request->hasFile('ownership')) {
            $ofileimg = $request->ownership;
            $oextension = $ofileimg->getClientOriginalExtension();
            $oname = time() . rand(11111, 99999) . '.' . $oextension;
            $ofileimg->move('uploads/chalet_uploads/ownership', $oname);
            $chalet_ownership = $oname;
        } else {
            $chalet_ownership = $ownerdetails->chalet_ownership;
        }
        if ($request->hasFile('agreement')) {
            $afileimg = $request->agreement;
            $aextension = $afileimg->getClientOriginalExtension();
            $aname = time() . rand(11111, 99999) . '.' . $aextension;
            $afileimg->move('uploads/chalet_uploads/agreement', $aname);
            $agreement = $aname;
        } else {
            $agreement = $ownerdetails->agreement;
        }
        Owner::where('id', $request->ownerid)->update(array('first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'country' => $request->country, 'phone' => $request->phone, 'gender' => $request->gender, 'profile_pic' => $profile_pic, 'civil_id' => $civil_id, 'chalet_ownership' => $chalet_ownership, 'agreement' => $agreement, 'bank_holder_name' => $request->holder_name, 'bank_name' => $request->bank_name, 'iban_num' => $request->iban_num, 'password' => $password));

        //    print_r($ownerdetails);die();
        if (!empty($civil_id)) {
            $civilid = "- CIVIL ID:" . url('uploads/chalet_uploads/civilid/') . '/' . $ownerdetails->civil_id;
        } else {
            $civilid = "";
        }
        if (!empty($chalet_ownership)) {
            $chalet_ownership = "- Chalet ownership:" . url('uploads/chalet_uploads/ownership/') . '/' . $ownerdetails->chalet_ownership;
        } else {
            $chalet_ownership = "";
        }
        if (!empty($agreement)) {
            $agreement = "- Agreement:" . url('uploads/chalet_uploads/agreement/') . '/' . $ownerdetails->chalet_ownership;
        } else {
            $agreement = "";
        }
        $data = array(
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'iban_num' => $request->iban_num,
            'owner_name' => $request->first_name . ' ' . $request->last_name,
            'civilid' => $civilid,
            'chalet_ownership' => $chalet_ownership,
            'agreement' => $agreement,
            'title' => 'Updated Owner Details',
            'email' => $request->email,
            'country' => $request->country,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => $request->password
        );
        Mail::send('ownermail', $data, function ($message) use ($email) {
            $message->to($email)->subject('Message');
            // $message->from('varshag.srishti@gmail.com', 'The Stock');
        });
        return back()->with('success', 'Successfully Updated Details');
    }
    public function owner_chaletlist($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['chaletlist'] = Chalet::select('*', 'tb_chalet.id as cid')->where('ownerid', $user_id)->get();
        return view('superadmin/sa_ownerchaletlist', $data);
    }
    public function totalreservation($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $data['chaletdetails'] = "";
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.ownerid', $user_id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->get();
        return view('superadmin/sa_totalreservations', $data);
    }
    public function send_bankdetails(Request $request)
    {
        $data['holder_name'] = $request->holder_name;
        $data['bank_name'] = $request->bank_name;
        $data['iban_num'] = $request->iban_num;
        $user_id = $request->ownerid;
        $email = $request->email;
        if (!empty($request->email)) {
            if (empty($request->holder_name) || empty($request->bank_name) || empty($request->iban_num)) {
                return response()->json(['success' => 'The Bank fields are empty']);
            } else {
                // echo $user_id;
                $ownerdetails = Owner::select('*')->where('id', $user_id)->first();
                //    print_r($ownerdetails);die();
                $data['owner_name'] = $ownerdetails->first_name . ' ' . $ownerdetails->last_name;
                if (!empty($ownerdetails->civil_id)) {
                    $civilid = "- CIVIL ID:" . url('uploads/chalet_uploads/civilid/') . '/' . $ownerdetails->civil_id;
                } else {
                    $civilid = "";
                }
                if (!empty($ownerdetails->chalet_ownership)) {
                    $chalet_ownership = "- Chalet ownership:" . url('uploads/chalet_uploads/ownership/') . '/' . $ownerdetails->chalet_ownership;
                } else {
                    $chalet_ownership = "";
                }
                if (!empty($ownerdetails->agreement)) {
                    $agreement = "- Agreement:" . url('uploads/chalet_uploads/agreement/') . '/' . $ownerdetails->chalet_ownership;
                } else {
                    $agreement = "";
                }
                $data = array(
                    'holder_name' => $request->holder_name,
                    'bank_name' => $request->bank_name,
                    'iban_num' => $request->iban_num,
                    'owner_name' => $ownerdetails->first_name . ' ' . $ownerdetails->last_name,
                    'civilid' => $civilid,
                    'chalet_ownership' => $chalet_ownership,
                    'agreement' => $agreement
                );
                Mail::send('bankmail', $data, function ($message) use ($email) {
                    $message->to($email)->subject('Message');
                    // $message->from('varshag.srishti@gmail.com', 'The Stock');
                });
                if (Mail::failures()) {
                    return response()->json(['success' => 'Failed to Send Mail.Please try again with valid email id.']);
                } else {
                    return response()->json(['success' => 'Successfully Send Mail.']);
                }
            }
        } else {
            return response()->json(['success' => 'Please Enter a mail to send.']);
        }
    }
    public function chaletreservation($cid, $wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($wid);
        $chalet_id = base64_decode($cid);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['chaletdetails'] = Chalet::select('*')->where('id', $chalet_id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.chaletid', $chalet_id)->get();
        return view('superadmin/sa_totalreservations', $data);
    }
    public function systemnotification($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($id);
        $data['notification'] = SystemNotification::where('id', $id)->first();
        return view('superadmin/sa_editnotificationsystem', $data);
    }
    public function update_systemnotification(Request $request)
    {
        $title = $request->title;
        $message = $request->message;
        $id = $request->id;
        SystemNotification::where('id', $id)->update(array('title' => $title, 'message' => $message));
        return redirect('/notifications-System')->with('success', 'Successfully Edited');
    }
    public function paidreservationinvoice($cid, $wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($wid);
        $chalet_id = base64_decode($cid);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['chaletdetails'] = Chalet::select('*')->where('id', $chalet_id)->first();
        $data['status'] = "Paid";
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.chaletid', $chalet_id)->where('tb_reservation.status', '=', 'paid')->get();
        return view('superadmin/sa_reservationinvoice', $data);
    }
    public function paidchaletreservationinvoice($wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($wid);
        $data['status'] = "Paid";
        $data['chaletdetails'] = "";
        $data['ownerdetails'] = Owner::select('*')->where('id', $id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.ownerid', $id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'paid')->get();
        return view('superadmin/sa_ownertotalpaid', $data);
    }
    public function unpaidchaletreservationinvoice($wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($wid);
        $data['status'] = "UnPaid";
        $data['chaletdetails'] = "";
        $data['ownerdetails'] = Owner::select('*')->where('id', $id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.ownerid', $id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_ownertotalpaid', $data);
    }
    public function remainingchaletreservationinvoice($wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id = base64_decode($wid);
        $data['status'] = "Remaining";
        $data['chaletdetails'] = "";
        $data['ownerdetails'] = Owner::select('*')->where('id', $id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.ownerid', $id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_ownertotalpaid', $data);
    }
    public function unpaidreservationinvoice($cid, $wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($wid);
        $chalet_id = base64_decode($cid);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['chaletdetails'] = Chalet::select('*')->where('id', $chalet_id)->first();
        $data['status'] = "UnPaid";
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.chaletid', $chalet_id)->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_reservationinvoice', $data);
    }
    public function remainingreservationinvoice($cid, $wid)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($wid);
        $chalet_id = base64_decode($cid);
        $data['ownerdetails'] = Owner::select('*')->where('id', $user_id)->first();
        $data['chaletdetails'] = Chalet::select('*')->where('id', $chalet_id)->first();
        $data['status'] = "Remaining";
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.chaletid', $chalet_id)->where('tb_reservation.status', '=', 'remaining')->get();
        return view('superadmin/sa_reservationinvoice', $data);
    }
    public function deleteowner($id)
    {
        $id = base64_decode($id);
        $count = Reservation::select('*')->where('ownerid', $id)->where('owner_status', '0')->count();
        if ($count == 0) {
            Owner::where('id', $id)->delete();
            return redirect('/Owner')->with('success', 'Successfully Deleted Owner');
        } else {
            return redirect('/Owner')->with('error', 'Reservations is pending for this Owner');
        }
    }
    public function update_refunddate(Request $request)
    {
        $refund_date = $request->refund_date;
        $id = $request->reserv_id;
        Reservation::where('id', $id)->update(array('refund_status' => '1', 'refund_date' => $refund_date));
        return response()->json(['success' => 'Successfully Updated']);
    }
    public function blockowner(Request $request)
    {
        $status = $request->status;
        $id = $request->ownerid;
        Owner::where('id', $id)->update(array('block_status' => $status));
        $ownerdetails = Owner::select('*')->where('id', $id)->first();
        $email = $ownerdetails->email;
        if ($status == 1) {
            $adminmessage = "Aby Chalet Blocked You";
        } else {
            $adminmessage = "Aby Chalet UnBlocked You";
        }
        $data = array(
            'title' => 'Hi! ' . $ownerdetails->first_name . ' ' . $ownerdetails->last_name,
            'message' => $adminmessage
        );
        Mail::send('blockmail', $data, function ($message) use ($email) {
            $message->to($email)->subject('Message');
            // $message->from('varshag.srishti@gmail.com', 'The Stock');
        });
        return response()->json(['success' => 'Successfully Blocked.']);
    }
    public function blockuser(Request $request)
    {
        $status = $request->status;
        $id = $request->userid;
        Users::where('id', $id)->update(array('block_status' => $status));
        return response()->json(['success' => 'Successfully Blocked.']);
    }
    public function unblockuser($id)
    { 
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $id=base64_decode($id);
        $userdetails = (new \App\Helper)->get_user_details($id);
        // print_r( $userdetails);die();
        Users::where('id', $id)->update(array('block_status' => '0'));
        return redirect('/users-blocked')->with('success', $userdetails->first_name.' '.$userdetails->last_name.', Has been UnBlock');
    }
    public function cancelreservation($id, $page)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        // $id = base64_decode($id);
        $reservation = Reservation::where('tb_reservation.id', $id)->select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->first();
        $userdetails = (new \App\Helper)->get_user_details($reservation->userid);
        // echo $reservation->userid;die();
        Reservation::where('id', $id)->update(array('booking_status' => '1'));
        if ($page == 'totalinvoice') {
            return redirect('/Chalet-Invoices-Total')->with("error", "The reservation was canceled, and the amount of (KD " . $reservation->total_paid . ") and Refund to " . $userdetails->first_name . " " . $userdetails->last_name    . ", 
        For Chalet ( " . $reservation->chalet_name . " )");
        } else if ($page == 'totalpaidinvoice') {
            return redirect('/Chalet-Invoices-Total-PAID')->with("error", "The reservation was canceled, and the amount of (KD " . $reservation->total_paid . ") and Refund to " . $userdetails->first_name . " " . $userdetails->last_name    . ", 
            For Chalet ( " . $reservation->chalet_name . " )");
        } else if ($page == 'depositinvoice') {
            return redirect('/Chalet-Invoices-Total-Deposits')->with("error", "The reservation was canceled, and the amount of (KD " . $reservation->total_paid . ") and Refund to " . $userdetails->first_name . " " . $userdetails->last_name    . ", 
            For Chalet ( " . $reservation->chalet_name . " )");
        }else if($page == 'userreservation') {
            $id = base64_encode($reservation->userid);
            // echo $id;die();
            return redirect('/User-Reservations/' . $id)->with("error", "The reservation was canceled, and the amount of (KD " . $reservation->total_paid . ") and Refund to " . $userdetails->first_name . " " . $userdetails->last_name    . ", 
            For Chalet ( " . $reservation->chalet_name . " )");
        }
    }
    public function owner_deposit(Request $request)
    {
        $id = $request->reserv_id;
        Reservation::where('id', $id)->update(array('owner_moneydeposit' => '1'));
        return response()->json(['success' => 'Successfully Updated']);
    }
    public function userreservation($id)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $data['userdetails'] = Users::select('*')->where('id', $user_id)->first();
        $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.userid', $user_id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->get();
    //    print_r($data['reservationlist']);die();
        return view('superadmin/sa_userreservation', $data);
    }
    public function userinvoice($id,$page)
    {
        if (session('adminlog') == false) {
            return redirect('/admin')->with('error', 'Your current session was timed-out and you have been logged out.Please login again to continue.');
        }
        $user_id = base64_decode($id);
        $page = base64_decode($page);
        $data['pages'] =  $page ;
        $data['userdetails'] = Users::select('*')->where('id', $user_id)->first();
        if($page=='paid')
        {$data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.userid', $user_id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'paid')->get();
        }elseif($page=='unpaid'){
            $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.userid', $user_id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'remaining')->get();
        }else{
            $data['reservationlist'] = Reservation::select('*', 'tb_chalet.id as cid', 'tb_reservation.id as rid')->where('tb_reservation.userid', $user_id)->join('tb_chalet', 'tb_chalet.id', '=', 'tb_reservation.chaletid')->where('tb_reservation.status', '=', 'remaining')->get();
        }
            //    print_r($data['reservationlist']);die();
        return view('superadmin/sa_userinvoices', $data);
    }
}
