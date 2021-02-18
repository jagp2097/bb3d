<?php

namespace bagrap\Http\Controllers\Auth;

use bagrap\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use bagrap\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Openpay;

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
            'nombre'    => array('required', 'regex:/[a-zA-Z]/', 'max:255'),
            'apellidos' => array('required', 'regex:/[a-zA-Z]/', 'max:255'),
            'fecha_nacimiento' => 'required|before:'. date('d/m/Y') .'|date_format:d/m/Y', // 10/03/1997
            'pais_origen' => array('required', 'regex:/[a-zA-Z]/', 'max:255'),
            'telefono' => array('required', 'size:14', 'regex: /^[(][0-9][0-9][)]*[\s0-9]*$/'), 
            // 'telefono' => array('required', 'size:14', 'regex: /^[(][+][0-9][0-9][)]*[\s0-9]*$/'), 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'openpay_id' => 'nullable',
        ], [
            'telefono.size' => 'Por favor, ingrese un número correcto',
            'telefono.regex' => 'Por favor, ingrese un número correcto',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \bagrap\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $user = new User();
        $user = User::create([
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'openpay_id' => null,
            'role_id'    => 2,
            'is_active'  => 1,
          ]);

        // Creación del perfil
        $profile = $user->perfil()->create([
            'nombre'           => $data['nombre'],
            'apellidos'        => $data['apellidos'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'pais_origen'      => $data['pais_origen'],
            'telefono'         => $data['telefono'],
            'foto'             => 'default.png',
        ]);

        // Creación de cliente en openpay
        $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');

        $customerData = [
            'name'             => $data['nombre'],
            'last_name'        => $data['apellidos'],
            'email'            => $data['email'],
            'requires_account' => false,
            'phone_number'     => $data['telefono'],
        ];

        $newCustomer = $openpay->customers->add($customerData);

        //Se inserta el id generado por openpay al crear al usuario
        Arr::set($user, 'openpay_id', $newCustomer->id);
        $user->save();

        return $user;
    }

    public function redirectTo()
    {
      $user = Auth::user();
      return route('perfil.show');
      // return $user->isActive() ? route('profile.show') : route('user.inactive');
    }

}
