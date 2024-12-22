<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CustomHelper;
use App\Mail\UserControllerMailable;
use App\Models\Area;
use App\Models\Branch;
use App\Models\CustomRole;
use App\Models\Event;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Ver Usuarios')->only('index');
        $this->middleware('can:Crear Usuario')->only('create', 'store');
        $this->middleware('can:Actualizar Usuario')->only('edit', 'update');
        $this->middleware('can:Eliminar Usuario')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuthenticated =  User::find(Auth::user()->id);

        if ($userAuthenticated->isSuperAdmin()) {
            $users  = User::all();

        } elseif ($userAuthenticated->isAdmin()) {
            $users  = User::all();

        } else {
            $users  = collect();

        }
        
        return view('admin.users.index', compact('users', 'userAuthenticated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account        = SharedController::getUserData();
        $companies      = $account->companies;
        $company_id     = $account->company_id;
        $roles          = Role::all()->where('name', '!=', CustomRole::SUPERADMIN);

        return view('admin.users.create', compact(
            'companies', 'company_id', 'roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id'    => 'required',
            'name'          => [
                'required',
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, true, 5);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'rut'           => 'required|unique:users',
            'email'         => 'required|email|unique:users',
            'role_id'       => 'required',
        ]);
        
        if ( strlen($request->phone) != 8 || !is_numeric($request->phone) ) {
            $request->merge(['phone' => null]);
        }

        $auxPass        = str_replace(".", "", $request->rut);
        $pass           = substr($auxPass, 0, 4);

        $user   = User::create([
            'rut'           => $request->rut,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($pass),
            'phone'         => $request->phone,
            'company_id'    => $request->company_id,
        ]);

        $user->roles()->attach($request->role_id);

        // foreach ($request->branches as $id) {
        //     $user->branches()->attach($id);

        //     Event::create([
        //         'action'        => Event::CREATE,
        //         'branch_id'     => $id,
        //         'object_id'     => $user->id,
        //         'object_type'   => "App\Models\User",
        //     ]);
        // }
        
        $email  = new UserControllerMailable('Bienvenido(a) a la Mantención de Embalses', 'admin.emails.users.create', $user, $pass);
        Mail::to($request->email)->send($email);

        return redirect()->route('admin.users.index')->with('success', 'Se ha agregado el usuario exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $account        = SharedController::getUserData();
        $companies          = $account->companies;
        $company_id         = $user->company->id;
        $roles              = Role::all()->where('name', '!=', CustomRole::SUPERADMIN);
        $states             = [User::ACTIVE, User::DISABLED];

        return view('admin.users.edit', compact(
            'companies', 'company_id', 'roles', 'states', 'user'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'company_id'    => "required",
            'name'      => [
                'required',
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, true, 5);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'rut'       => "required|unique:users,rut,$user->id",
            'email'     => "required|email|unique:users,email,$user->id",
            'is_active' => "required|in:" . User::ACTIVE . "," . User::DISABLED,
            'role_id'   => "required"
        ]);

        if ( strlen($request->phone) != 8 || !is_numeric($request->phone) ) {
            $request->merge(['phone' => null]);
        }

        $user->update([
            'rut'           => $request->rut,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'is_active'     => $request->is_active,
            'company_id'    => $request->company_id,
        ]);

        $user->roles()->sync($request->role_id);

        // foreach ($request->branches as $id) {
        //     Event::create([
        //         'action'        => Event::UPDATE,
        //         'branch_id'     => $id,
        //         'object_id'     => $user->id,
        //         'object_type'   => "App\Models\User",
        //     ]);
        // }
        
        return redirect()->route('admin.users.index')->with('success', 'Se han actualizado los datos exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $email  = new UserControllerMailable('Suspensión Acceso', 'admin.emails.users.delete', $user);
        Mail::to($user->email)->send($email);

        // foreach ($user->branches as $branch) {
        //     Event::create([
        //         'action'        => Event::DELETE,
        //         'branch_id'     => $branch->id,
        //         'object_id'     => $user->id,
        //         'object_type'   => "App\Models\User",
        //     ]);
        // }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Se ha eliminado el usuario exitosamente');
    }
}
