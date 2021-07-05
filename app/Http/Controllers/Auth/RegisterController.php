<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\GrantPoint;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:191', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (!isset($data['email'])) {
            $data['email'] = '';
        }

        $image = '';
        if (!app()->runningUnitTests()) {
            $image = Storage::disk('s3')->url('img/avatars/noimage.jpg');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' => $image,
        ]);

        $date = new Carbon;
        GrantPoint::create([
            'user_id' => $user->id,
            'grant_point' => 500,
            'available_point' => 500,
            'expiration_date' => $date->addMonth(1)->format('Y-m-d'),
        ]);

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        return $user;
    }
}
