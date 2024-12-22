<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CustomRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superUser  = User::create([
            'rut'           => '19.040.800-0',
            'name'          => 'Felipe Leiva Cortés',
            'phone'         => 949433578,
            'email'         => 'felipe-leiva@hotmail.cl',
            'password'      => bcrypt('LtLt1505#"!'),
            'company_id'    => 1,
        ]);

        $superUser->assignRole(CustomRole::SUPERADMIN);
    }
}
