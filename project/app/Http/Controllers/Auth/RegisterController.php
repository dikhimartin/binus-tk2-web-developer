<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\User_role;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/admin/dashboard';

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
        $messages = [
            'password.min' => __('passwords.password_validate_1'),
            'password.regex' => __('passwords.password_validate_2'),
        ];
    
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:10', // must be at least 10 characters
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{10,}$/'
            ],
        ];
    
        // add captcha validation rule if in production environment
        if (config('app.env') === 'production') {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }
    
        return Validator::make($data, $rules, $messages);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $table="users";
        $primary="id_users";
        $prefik="K";
        $uniqueCode=User::autonumber($table,$primary,$prefik);
        $guest_role = 2;

        $user = new User;
        $user->id_users       = $uniqueCode;
        $user->username       = $data['username'];
        $user->name           = $data['name'];
        $user->id_level_user  = $guest_role;
        $user->status         = "Y";
        $user->password       = bcrypt($data['password']);
        $user->save();

        $role_user = new User_role;
        $role_user->user_id = $user->id_users;
        $role_user->role_id = $guest_role;
        $role_user->save();
        
       return $user;
    }
}
