<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    const STATE_OPEN        = '0';
    const STATE_REVIEWED    = '1';

    /**
     * Devuelve la sucursal que tiene registrada esta sugerencia.
     */
    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
