<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.passwords.email');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.passwords.reset', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {

                // Sinao
                Http::post(config('app.sinao').'masuk', [
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'init' => 'smart'
                ]);

                // Tebar
                Http::post(config('app.tebar').'masuk', [
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'init' => "smart"
                ]);

                // Jogja
                Http::post(config('app.jogja').'masuk', [
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'init' => "smart"
                ]);

                // EZPay
                Http::post(config('app.ezpay').'masuk', [
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'init' => "smart"
                ]);

                // Cilik
                Http::post(config('app.cilik').'masuk', [
                    'email' => $request->email,
                    'password' => $request->password,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'init' => "smart"
                ]);

                return $user;
            }
        });
    }
}
