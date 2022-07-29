<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],  // confirmed fra un confronto fra la password inserita e quella di conferma; analizzare register.blade.php
            'address' => ['string', 'max: 100'],
            'phone' => ['string', 'max: 20'],
            'birth' => ['date'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // creo UserDetails e devo mettere in relazione la tabella users con users_details (guardare il file con le tabelle creato in phpMyAdmin)
        UserDetails::create([   // importare la classe UserDetails
            'user_id' => $user->id,    // una volta che mi son registrato ($user), passo alla tabella users_details l id di $user appena creato
            'address' => $data['address'],
            'phone' => $data['phone'],
            'birth' => $data['birth'],
        ]);

        return $user;

    }
}
