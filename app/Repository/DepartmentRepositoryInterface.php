<?php
declare(strict_types=1);

namespace App\Repository;

interface DepartmentRepositoryInterface
{
    public function all();
    public function store(array $departmentData);
    public function getDepartment(int $id);
    public function update(array $departmentData);
    public function delete(int $departmentId);
}
