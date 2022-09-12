<?php

namespace App\Http\Livewire\Funcionarios;

use App\Models\Employee\Employee;
use App\Services\EmployeeService;
use Illuminate\Support\Arr;
use Livewire\Component;
use PHPUnit\Util\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Funcionario extends Component
{
    public $data;
    public $roles;
    public $permissions;
    public bool $permissionsIsAvaliable = false;
    public bool $allPermissionsTo = false;

    public array $rules =
    [
        'data.name' => "required|string",
        'data.role' => "required|string",
        'data.cellphone' => "required|string",
        'data.cpf' => "required|integer",
        'data.email' => "required|email|unique:employees,email",
        'data.password' => "required|string|min:3|confirmed",
    ];

    public function render()
    {
        return view('livewire.funcionarios.funcionario');
    }

    public function mount()
    {
        $this->roles = Role::query()->orderBy('name', 'asc')->get();
        $this->permissions = Permission::query()->orderBy('name', 'asc')->get();
    }

    public function updated($value)
    {
        switch ($value)
        {
            case "data.role":
                $this->permissionsIsAvaliable = true;
                break;
            default:
                break;
        }
    }

    public function save()
    {
        $this->data["permissions"] = array_values($this->data['permissions']);
        if(!$this->validateAuthFields($this->data)){
            throw new Exception("Erro ao validar senha");
        }
        $employeeService = new EmployeeService();
        $role = $this->data["role"];
        $permissions = $this->data["permissions"];
        unset($this->data["permissions"], $this->data["role"], $this->data["password_confirmation"]);
        $user = $employeeService->createUser($this->data);
        $this->data['user_id'] = $user->id;
        $employee = $employeeService->create($this->data);
        $this->syncPermissionsRoles($user, $role, $permissions);
    }

    protected function validateAuthFields($data) : bool
    {
        if($data["password"] !== $data["password_confirmation"]){
            return false;
        }
        return true;
    }

    protected function syncPermissionsRoles($user, $role, array $permissions)
    {
        $user->assignRole($role);
        $user->syncPermissions($permissions);
    }
}
