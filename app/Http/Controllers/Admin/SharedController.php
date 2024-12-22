<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CustomRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SharedController extends Controller
{
    public static function getUserData() {
        $user_id        = Auth::user()->id;
        $user           = User::find($user_id);

        /**
         * Si es SuperAdmin puede tener muchas empresas y muchas sucursales.
         * Si es Admin, sólo puede tener una empresa, pero, una o muchas sucursales.
         */
        if ($user->isSuperAdmin()){
            $companies  = Company::where('id', '!=', 1)->get();
            $company_id = null;

        } else {
            $companies  = $user->company;
            $company_id = $companies->id;

        }

        return (object)[
            'user'          => $user,
            'companies'     => $companies,
            'company_id'    => $company_id,
        ];
    }

    public static function getDeliveryEmails(User $user) {
        // $branch     = $user->branches[0];
        // $emails[]   = $user->email;
            
        // $admins     = User::where('is_active', 1)->whereHas('branches', function($query) use ($branch) {
        //     $query->where('branch_id', $branch->id);
        // })->role(CustomRole::ADMIN)
        //     ->select('email')
        //     ->get();

        // foreach ($admins as $admin) {
        //     $emails[]   = $admin->email;
        // }
        // return $emails;
        return [];
    }
}
