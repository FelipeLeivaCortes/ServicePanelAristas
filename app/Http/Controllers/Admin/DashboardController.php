<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Piezometria;
use App\Models\Record;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account    = SharedController::getUserData();
        
        $companies  = $account->companies;
        $user       = $account->user;
        $users      = User::all();
        $license    = null;

        // INFORMACIÓN SÓLO PARA ADMINISTRADORES Y PERSONAL DE MANTENCIÓN
        if (!$user->isSuperAdmin()) {
            $license = Company::licenseDetails($companies);
        }
        
        return view('admin.dashboard.index', compact(
            'companies', 'license', 'users'
        ));
    }
}
