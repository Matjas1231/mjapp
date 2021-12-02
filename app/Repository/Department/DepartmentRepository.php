<?php
declare(strict_types=1);

namespace App\Repository\Department;

use App\Models\Department;
use App\Repository\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    private Department $departmentModel;

    public function __construct(Department $departmentModel)
    {
        $this->departmentModel = $departmentModel;
    }
    public function all()
    {
        return $this->departmentModel->all();
    }

    public function store(array $deparmentData)
    {
        $department = $this->departmentModel->newInstance();
        $department->name = $deparmentData['name'];

        return $department->save();
    }

    public function getDepartment(int $id)
    {
        return $this->departmentModel->find($id);
    }

    public function update(array $deparmentData)
    {
        $department = $this->departmentModel->find($deparmentData['id']);
        $department->name = $deparmentData['name'];
        return $department->save();
    }

    public function delete(int $departmentId)
    {
        $department = $this->departmentModel->find($departmentId);
        return $department->delete();
    }
}
