<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\AdditionalAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'regex:/^\d{11}$/'],
        'address_first_line' => ['required', 'string', 'max:255'],
        'address_second_line' => ['nullable', 'string', 'max:255'],
        'address_third_line' => ['nullable', 'string', 'max:255'],
        'town' => ['nullable', 'string', 'max:255'],
        'postcode' => ['nullable', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], 
        [
            'phone.regex' => 'The phone number must be exactly 11 digits.',
            'email.unique' => 'The email has already been taken.',
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
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'address_first_line' => $data['address_first_line'],
            'address_second_line' => $data['address_second_line'],
            'address_third_line' => $data['address_third_line'],
            'town' => $data['town'],
            'postcode' => $data['postcode'],
        ]);

        return $user;
    }

}
