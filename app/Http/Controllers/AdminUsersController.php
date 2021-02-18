<?php

namespace bagrap\Http\Controllers;

use bagrap\User;
use bagrap\Role;
use Illuminate\Http\Request;
use bagrap\Events\Admin_Create_User;
use bagrap\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use Openpay;


class AdminUsersController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
    $this->middleware('verified');
    $this->middleware('isActive');
    
  }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');

        $findDataRequest = [
            'creation[gte]' => '2019-01-01',
            'creation[lte]' => '2019-12-31',
            'offset' => 0,
            'limit' => 5,
        ];

        $customerList = $openpay->customers->getList($findDataRequest);

        $users = User::all();

        return view('admin.user.index', [
            'users' => $users,
            'clientes' => $customerList
        ]);
    }

    public function deleteCustomer($idCustomer)
    {
        // dd($idCustomer);
        $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');

        $customer = $openpay->customers->get($idCustomer);

        $customer->delete();

        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();

        return view('admin.user.create', [
            'user' => $user,
            'roles' => $roles,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');

        $user = new User();

        $user = User::create([
            'email' => $request->input('email_usuario'),
            'password' => Hash::make('a1b2c3'),
            'role_id' => $request->input('rol_usuario'),
            'is_active' => $request->input('status_usuario'),
        ]);

        $perfil = $user->perfil()->create([
            'nombre' => $request->input('nombre_usuario'),
            'ap_pa' => $request->input('ap_pa_usuario'),
            'ap_ma' => $request->input('ap_ma_usuario'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento_usuario'),
            'pais_origen' => $request->input('pais_usuario'),
            'estado' => $request->input('estado_usuario'),
            'ciudad' => $request->input('ciudad_usuario'),
            'direccion' => $request->input('direccion_usuario'),
            'telefono' => $request->input('telefono_usuario'),
        ]);

        event(new Admin_Create_User($user));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return $user->perfil;
        return view('admin.user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.create', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // return $request;
        $user->update([
            // 'email' => $request->input('email_usuario'),
            'password' => Hash::make('a1b2c3'),
            'role_id' => $request->input('rol_usuario'),
            'is_active' => $request->input('status_usuario'),
        ]);

        $user->perfil()->update([
            'nombre' => $request->input('nombre_usuario'),
            'ap_pa' => $request->input('ap_pa_usuario'),
            'ap_ma' => $request->input('ap_ma_usuario'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento_usuario'),
            'pais_origen' => $request->input('pais_usuario'),
            'estado' => $request->input('estado_usuario'),
            'ciudad' => $request->input('ciudad_usuario'),
            'direccion' => $request->input('direccion_usuario'),
            'telefono' => $request->input('telefono_usuario'),
        ]);

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->perfil()->delete($user->id);
        $user->delete($user->id);

        return redirect()->route('users.index');
    }
}
