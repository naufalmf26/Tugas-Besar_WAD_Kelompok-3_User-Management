<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = '')
    {
        if(empty($id)){
            $user = Auth::user();
        }else{
            $user = User::findOrFail($id);
        }
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));

                // update password
                // ezpay
                Http::post(config('app.ezpay').'password', [
                    'current_password' => $request->input('current_password'),
                    'new_password' => $request->input('new_password'),
                    'email' => $request->input('email')
                ]);

                // sinao
                Http::post(config('app.sinao').'password', [
                    'current_password' => $request->input('current_password'),
                    'new_password' => $request->input('new_password'),
                    'email' => $request->input('email')
                ]);

                // tebar
                Http::post(config('app.tebar').'password', [
                    'current_password' => $request->input('current_password'),
                    'new_password' => $request->input('new_password'),
                    'email' => $request->input('email')
                ]);

                // jogja
                Http::post(config('app.jogja').'password', [
                    'current_password' => $request->input('current_password'),
                    'new_password' => $request->input('new_password'),
                    'email' => $request->input('email')
                ]);

                // cilik
                Http::post(config('app.cilik').'password', [
                    'current_password' => $request->input('current_password'),
                    'new_password' => $request->input('new_password'),
                    'email' => $request->input('email')
                ]);

            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        // update profile
        // ezpay
        Http::post(config('app.ezpay').'update', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // sinao
        Http::post(config('app.sinao').'update', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // tebar
        Http::post(config('app.tebar').'update', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // jogja
        Http::post(config('app.jogja').'update', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // cilik
        Http::post(config('app.cilik').'update', [
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);



        return redirect()->route('profile');
    }
}
