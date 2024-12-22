<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CustomHelper;
use App\Models\CustomPermission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Ver Permisos')->only('index', 'show');
        $this->middleware('can:Crear Permiso')->only('create', 'store');
        $this->middleware('can:Actualizar Permiso')->only('edit', 'update');
        $this->middleware('can:Eliminar Permiso')->only('delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('order', 'asc')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families   = CustomPermission::FAMILIES;
        return view('admin.permissions.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => [
                'required',
                'unique:permissions',
                function ($attributes, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, false, 4);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'family'    => 'required',
            'order'     => 'required|numeric|min:1',
        ]);

        try {
            $permission = Permission::create([
                'name'      => $request->name,
                'family'    => $request->family,
                'order'     => $request->order,
            ]);

            if ( isset($permission) ) {
                $state  = 'success';
                $msg    = 'Se ha registrado el permiso exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al registrar el permiso. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.permissions.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('permisos', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $families   = CustomPermission::FAMILIES;
        return view('admin.permissions.edit', compact('permission', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'          => [
                'required',
                "unique:permissions,name,$permission->id",
                function ($attributes, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, false, 5);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'family'    => 'required',
            'order'     => 'required|numeric|min:1',
        ]);

        try {
            $success    = $permission->update([
                'name'      => $request->name,
                'family'    => $request->family,
                'order'     => $request->order,
            ]);

            if ( $success ) {
                $state  = 'success';
                $msg    = 'Se ha actualizado el permiso exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al actualizar el permiso. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.permissions.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('permisos', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {

            $success    = $permission->delete();

            $state  = $success ? 'success' : 'error';
            $msg    = $success ? 'Se ha eliminado el permiso exitosamente.' :
                                'No se ha logrado eliminar el permiso. Comuníquese con el administrador.';

            return redirect()->route('admin.permissions.index')->with($state, $msg);
        
        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('permisos', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }
}
