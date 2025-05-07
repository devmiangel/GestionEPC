<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'primer_nombre' => ['required','string','max:255'],
            'primer_apellido' => ['required','string','max:255'],
            'num_documento' => ['required','string','max:255','unique:personas'],
            'id_tipdocumento' => ['required','integer'],
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
        $persona = Persona::create([
            'primer_nombre' => $data['primer_nombre'],
            'primer_apellido' => $data['primer_apellido'],
            'num_documento' => $data['num_documento'], 
            'id_tipdocumento' => $data['id_tipdocumento'],
            
        ]);
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_persona' => $persona->id
        ]);

        return $user;
    }
}
