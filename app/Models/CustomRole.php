<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{
    use HasFactory;

    public $guarded     = ['id'];

    const SUPERADMIN    = 'SuperAdmin';
    const ADMIN         = 'Admin';
}
