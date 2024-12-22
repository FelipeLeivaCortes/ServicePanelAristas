<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Constructor with the access control
     */
    public function __construct(){
        $this->middleware('can:Ver Empresas')->only('index', 'show');
        $this->middleware('can:Crear Empresa')->only('create', 'store');
        $this->middleware('can:Actualizar Empresa')->only('edit', 'update');
        $this->middleware('can:Eliminar Empresa')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies  = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
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
            "rut"           => "required|unique:companies",
            "name"          => [
                "required",
                "unique:companies",
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, true, 4);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            "email"         => "required|email|unique:companies",
            "address"       => "required|unique:companies",
            "license_start" => "required|date",
            "license_end"   => "required|date|after:license_start",
            "logo"          => "file|mimes:png",
        ]);

        try {
            $request['waterholes']  = 0;
            $company    = Company::create($request->all());

            if ( $request->file('logo') ) {
                $img        = $request->file('logo')->store("public/company_$company->id/images");
                $company->image()->create(['url' => Storage::url($img) ]);
            }

            if ( isset($company) ) {
                $state  = 'success';
                $msg    = 'Se ha registrado la empresa exitosamente.';
            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al registrar la empresa. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.companies.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('empresas', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company  $company
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'rut'           => "required|unique:companies,rut,$company->id",
            'name'          => [
                "required",
                "unique:companies,name,$company->id",
                function ($attribute, $value, $fail) {
                    $isValidName    = CustomHelper::isValidName($value, true, 4);

                    if (!$isValidName['state']) {
                        $fail($isValidName['msg']);
                    }
                }
            ],
            'email'         => "required|email|unique:companies,email,$company->id",
            'address'       => "required|unique:companies,address,$company->id",
            'license_start' => "required|date",
            'license_end'   => "required|date|after:license_start",
            'logo'          => "file|mimes:png",
            'branches'      => "array",
        ]);

        try {
            $success    = $company->update($request->all());

            if ( $success ) {
                if ( $request->file('logo') ) {

                    if ( $company->image == null ) {
                        $img    = $request->file('logo')->store("public/company_$company->id/images");
                        $company->image()->create(['url' => Storage::url($img) ]);
        
                    }else{
                        $urlFile    = str_replace('storage', 'public', $company->image->url);
                        Storage::delete($urlFile);
        
                        $img    = $request->file('logo')->store("public/company_$company->id/images");
                        $company->image()->update(['url' => Storage::url($img) ]);
                    }
                }

                $state  = 'success';
                $msg    = 'Se han actualizado los datos de la empresa exitosamente.';

            } else {
                $state  = 'error';
                $msg    = 'Se ha producido un error al actualizar los datos de la empresa. Comuníquese con el administrador.';
            }

            return redirect()->route('admin.companies.index')->with($state, $msg);

        } catch(Exception $e){
            $user   = User::find(Auth::user()->id);
            $errors = CustomHelper::exceptionToArray($e);

            CustomHelper::downloadErrorFile('empresas', $user->company->id, $errors);
            return back()->with('error', 'Se ha ocurrido un error inesperado. Comuníquese con el administrador.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ( !is_null($company->image) ) {
            $urlFile    = str_replace('storage', 'public', $company->image->url);
            Storage::delete($urlFile);
        }

        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Se ha eliminado la empresa exitosamente');
    }
}
