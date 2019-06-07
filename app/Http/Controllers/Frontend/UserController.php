<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'national_code'=>'required',
            'password'=>'required',
            'company'=>'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->national_code = $request->input('national_code');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $address = new Address();
        $address->company = $request->input('company');
        $address->address = $request->input('address');
        $address->post_code = $request->input('post_code');
        $address->province_id = $request->input('province_id');
        $address->city_id = $request->input('city_id');
        $address->user_id = 1 ;
        $address->save();

        Session::flash('user_register','ثبت نام با موفقیت انجام شد ، لطفا حساب خود را توسط ایمیل تایید نمائید.');
        return redirect('/login');
    }

    public function profile()
    {
        return view('frontend/profile/index');
    }
}
