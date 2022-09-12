<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Exibir Funcionários', 'guard_name' => 'web']);
        Permission::create(['name' => 'Exibir Usuários', 'guard_name' => 'web']);
        Permission::create(['name' => 'Formulário de cadastro', 'guard_name' => 'web']);
        Permission::create(['name' => 'Barra de status de venda', 'guard_name' => 'web']);
        Permission::create(['name' => 'Barra de status da instalação', 'guard_name' => 'web']);
        Permission::create(['name' => 'Exibir todos os registros', 'guard_name' => 'web']);
        Permission::create(['name' => 'Excluir registros', 'guard_name' => 'web']);
        Permission::create(['name' => 'Editar Registros', 'guard_name' => 'web']);
    }
}
