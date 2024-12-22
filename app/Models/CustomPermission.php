<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPermission extends Model
{
    use HasFactory;

    const FAMILIES = [
        'companies'     => ['name' => 'Empresas',       'order' => 1],
        'permissions'   => ['name' => 'Permisos',       'order' => 2],
        'roles'         => ['name' => 'Roles',          'order' => 3],
        'users'         => ['name' => 'Usuarios',       'order' => 4],
        'sync'          => ['name' => 'Sincronizador',  'order' => 5]
    ];

    const CRUD_COMPANIES    = ['Ver Empresas',      'Crear Empresa',        'Actualizar Empresa',       'Eliminar Empresa'];
    const CRUD_PERMISSIONS  = ['Ver Permisos',      'Crear Permiso',        'Actualizar Permiso',       'Eliminar Permiso'];
    const CRUD_ROLES        = ['Ver Roles',         'Crear Rol',            'Actualizar Rol',           'Eliminar Rol'];
    const CRUD_USERS        = ['Ver Usuarios',      'Crear Usuario',        'Actualizar Usuario',       'Eliminar Usuario'];
    const CRUD_SYNC         = ['Ver Sincronizador', 'Crear Sincronizador',  'Actualizar Sincronizador', 'Eliminar Sincronizador'];
}
