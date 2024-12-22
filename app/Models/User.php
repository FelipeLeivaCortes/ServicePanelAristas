<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * States of the user
     */
    const ACTIVE    = 1;
    const DISABLED  = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rut',
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * AdminLte Menu Configuration
    */
    public function adminlte_desc()
    {
        return User::find( Auth::user()->id )->roles[0]->name;
    }

    public function adminlte_profile_url()
    {
        return url('admin/profile');
    }
 
    public function adminlte_image()
    {
        $user   = User::find(Auth::user()->id);

        if ( $user->profile_photo_path ) {
            return asset($user->profile_photo_path);
        } else {
            return asset('storage/img/default_user.png');
        }
    }
 
 
    /**
     * Devuelve una lista con las sucursales que tiene registradas este usuario.
     */
    public function company(){
        return $this->belongsTo(Company::class);
    }

    /**
     * Devuelve verdadero si el usuario tiene el rol de SuperAdmin.
     */
    public function isSuperAdmin() {
        $user   = User::find(Auth::user()->id);
        return $user->hasRole([CustomRole::SUPERADMIN]);
    }

    /**
     * Devuelve verdadero si el usuario tiene el rol de Admin.
     */
    public function isAdmin() {
        $user   = User::find(Auth::user()->id);
        return $user->hasRole([CustomRole::ADMIN]);
    }
}
