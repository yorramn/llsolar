<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Administração', 'guard_name' => 'web']);
        Role::create(['name' => 'Financeiro', 'guard_name' => 'web']);
        Role::create(['name' => 'Vendas', 'guard_name' => 'web']);
        Role::create(['name' => 'Operacional', 'guard_name' => 'web']);
    }
}
