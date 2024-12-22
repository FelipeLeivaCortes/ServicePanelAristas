<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $guarded    = ['id'];

    /**
     * Devuelve verdadero si la licencia está vigente y falso sino lo esta.
     */
    public function isValidLicense() {
        $today      = Carbon::create(date('Y-m-d'));
        $license    = Carbon::create($this->license_end);
        
        return $license->gt($today);
    }

    /**
     * Devuelve los detalles de la licencia actual.
     */
    public static function licenseDetails(Company $company) {
        $today          = Carbon::create(date('Y-m-d'));
        $license_start  = Carbon::create($company->license_start);
        $license_end    = Carbon::create($company->license_end);

        $all_days = $license_start->diffInDays($license_end);
        $old_days = $all_days - $today->diffInDays($license_end);
        $percentage = $old_days / $all_days;


        $data = collect();
        $data->put('start', $company->license_start);
        $data->put('end', $company->license_end);
        $data->put('all_days', $all_days);
        $data->put('remaining', $today->diffInDays($license_end));
        $data->put('achieved', $percentage * 100);

        return $data;
    }

    /**
     * Devuelve la imagen corporativa.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
