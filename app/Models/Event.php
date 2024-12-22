<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    const DELETE    = 'Eliminar';
    const UPDATE    = 'Actualizar';
    const CREATE    = 'Agregar';
}
