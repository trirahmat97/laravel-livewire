<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['Super Admin', 'Administrator', 'Kepala Desa', 'Operator', 'Kadus', 'Rw', 'Rt']);
        $roles->each(function ($r) {
            Role::create([
                'name' => $r,
                'guard_name' => 'web'
            ]);
        });
    }
}
