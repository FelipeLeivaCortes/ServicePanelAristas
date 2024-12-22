<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user   = User::find(Auth::user()->id);
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_pass'  => 'required',
            'new_pass'      => 'required',
            'confirm_pass'  => 'required',
        ]);


        if ( !password_verify($request->current_pass, $user->password) ){
            return back()->with('error', 'La contraseña ingresada no coincide con la registrada');
        }

        if ( $request->new_pass != $request->confirm_pass ) {
            return back()->with('error', 'La nueva contraseña y su confirmación no coinciden');
        }

        $user->update([
            'password'  => bcrypt($request->new_pass),
        ]);

        return redirect()->route('admin.profiles.index')->with('success', 'Se ha actualizado la contraseña exitosamente');
    }
}
