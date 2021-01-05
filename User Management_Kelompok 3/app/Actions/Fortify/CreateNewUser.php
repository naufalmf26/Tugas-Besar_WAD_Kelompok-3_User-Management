<?php

namespace App\Actions\Fortify;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // Sinao
        Http::post(config('app.sinao').'masuk', [
            'email' => $input['email'],
            'password' => $input['password'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'init' => 'smart'
        ]);

        // Tebar
        Http::post(config('app.tebar').'masuk', [
            'email' => $input['email'],
            'password' => $input['password'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'init' => "smart"
        ]);

        // Jogja
        Http::post(config('app.jogja').'masuk', [
            'email' => $input['email'],
            'password' => $input['password'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'init' => "smart"
        ]);

        // EZPay
        Http::post(config('app.ezpay').'masuk', [
            'email' => $input['email'],
            'password' => $input['password'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'init' => "smart"
        ]);

        // Cilik
        Http::post(config('app.cilik').'masuk', [
            'email' => $input['email'],
            'password' => $input['password'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'init' => "smart"
        ]);

        return User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => 2
        ]);
    }
}
