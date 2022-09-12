<?php

namespace App\Repositories;

interface EmployeeRepository
{
    public function getAll(?int $paginate);
    public function create($data);
    public function get(int $id);
    public function update(int $id, $data);
}
