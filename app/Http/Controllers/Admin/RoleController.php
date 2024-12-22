<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CustomHelper;
use App\Models\CustomPermission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Ver Roles')->only('index', 'show');
        $this->middleware('can:Crear Rol')->only('create', 'store');
        $this->middleware('can:Actualizar Rol')->only('edit', 'update');
        $this->middleware('can:Eliminar Rol')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles  = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families       = CustomPermission::FAMILIES;

        usort($families, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        foreach ($families as $family) {
            $permissions[] = [
                'family'        => $family['name'],
                'order'         => $family['order'],
                'permissions'   => Permission::where('family', $family['name'])->get(),
            ];
        }

        return view('admin.roles.create', compact('permissions'));
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
            'name'          => [
                'required',
                'unique:roles',
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, false, 5);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'permissions'   => 'required',
        ]);

        try {
            $role   = Role::create([
                'name'  => $request->name,
            ]);

            if ( isset($role) ) {
                $role->permissions()->attach($request->permissions);

                $state  = 'success';
                $msg    = 'Se ha registrado el rol exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al registrar el rol. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.roles.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('roles', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        foreach ( CustomPermission::FAMILIES as $family ){
            $permissions[] = [
                'family'        => $family['name'],
                'order'         => $family['order'],
                'permissions'   => Permission::where('family', $family['name'])->get(),
            ];
        }

        $ownPermissions = $role->permissions()->orderBy('id', 'asc')->get();

        return view('admin.roles.edit', compact('role', 'permissions', 'ownPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            "name"          => [
                "required",
                "unique:roles,name,$role->id",
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, false, 5);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            "permissions"   => "required",
        ]);

        try {
            $success    = $role->update([
                'name'  => $request->name,
            ]);
    
            if ($success) {
                $role->permissions()->sync($request->permissions);

                $state  = 'success';
                $msg    = 'Se ha actualizado el rol exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al actualizar el rol. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.roles.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('roles', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $success    = $role->delete();
    
            if ($success) {
                $state  = 'success';
                $msg    = 'Se ha eliminado el rol exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al eliminar el rol. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.roles.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('roles', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }
}
