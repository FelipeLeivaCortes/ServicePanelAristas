<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'rut'           => '19.040.800-0',
            'name'          => 'System',
            'address'       => 'Av. Américo Vespucio #1040',
            'email'         => 'proyecto.aristas@gmail.com',
            'license_start' => '1900-01-01',
            'license_end'   => '2100-01-01',
        ]);
    }
}
