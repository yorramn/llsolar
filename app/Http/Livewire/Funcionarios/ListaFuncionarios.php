<?php

namespace App\Http\Livewire\Funcionarios;

use App\Services\EmployeeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Component;
use PHPUnit\Util\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ListaFuncionarios extends Component
{
    public bool $showEmployee = false;
    public $employee;
    public $data;
    public $roles;
    public bool $edit = false;
    public $permissions;
    public array $selectedPermissions = [];
    protected $rules =
        [
            'data.permissions.*' => 'required',
            'data.role.*' => 'required',
        ];

    public function render()
    {
        $employeeService = new EmployeeService();
        return view('livewire.funcionarios.lista-funcionarios',["employees" => $employeeService->getAll()]);
    }

    public function mount()
    {
        $this->roles = Role::query()->orderBy('name', 'asc')->get();
        $this->permissions = Permission::query()->orderBy('name', 'asc')->get();
    }

    public function showSelectedEmployee(int $id)
    {
        $this->showEmployee = !$this->showEmployee;
        if($this->showEmployee){
            $employeeService = new EmployeeService();
            $this->employee = $employeeService->get($id);
            $this->selectedPermissions = array_fill_keys($this->employee->user->permissions->pluck('name')->toArray(), true);
            $this->data['employee'] = $this->employee;
            $this->data['role'] = $this->employee->user->roles->first()->name;
        }
    }

    protected function syncPermissionsRoles($user, $role, array $permissions)
    {
        $user->syncRoles([$role]);
        $user->syncPermissions($permissions);
    }

    public function canEditFields()
    {
        $this->edit = !$this->edit;
    }

    public function save()
    {
        $this->selectedPermissions = array_keys(array_filter($this->selectedPermissions));
        if(count($this->selectedPermissions) === 0){
            session()->flash('message', 'Selecione as permissões do seu funcionário!');
            session()->flash('class', 'danger');
            return redirect()->to('lista-funcionarios');
        }
        $employeeService = new EmployeeService();
        unset($this->data['employee']['user']['created_at'], $this->data['employee']['user']['updated_at'],$this->data['employee']['user']['permissions'], $this->data['employee']['user']['roles']);
        //dd($this->data);
        $user = $employeeService->updateUser($this->employee, $this->data['employee']['user']);
        if(!$user){
            session()->flash('message', 'Erro ao atualizar o usuário!');
            session()->flash('class', 'danger');
            return redirect()->to('lista-funcionarios');
        }
        $employeeService->create($this->data['employee']);
        $this->syncPermissionsRoles($user, $this->data['role'], $this->selectedPermissions);
        session()->flash('message', 'Usuário atualizado com sucesso!');
        session()->flash('class', 'success');
        return redirect()->to('lista-funcionarios');
    }
}
