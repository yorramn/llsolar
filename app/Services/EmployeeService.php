<?php

namespace App\Services;

use App\Models\Employee\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements \App\Repositories\EmployeeRepository
{

    public function getAll(?int $paginate = null)
    {
        return Employee::query()
            //->orderBy("name")
            ->paginate($paginate ?? 30);
    }

    public function create($data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Employee::query()->updateOrCreate(
            [
                'cpf' => $data["cpf"]
            ],
            [
                'cpf' => $data['cpf'],
                'cellphone' => $data['cellphone'],
                'user_id' => $data['user_id']
            ]
        );
    }

    public function get(int $id)
    {
        return Employee::query()->findOrFail($id);
    }

    public function update(int $id, $data)
    {
        // TODO: Implement update() method.
    }

    public function createUser($data)
    {
        $data["password"] = Hash::make($data["password"]);
        return User::query()->create($data);
    }

    public function updateUser(Employee $employee, $data)
    {
        if($employee->user()->update($data) === 1){
            return $employee->user()->first();
        }
        return null;
    }
}
