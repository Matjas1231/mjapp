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

    public function departmentSearch(?string $filterDep = null)
    {
        return $this->departmentModel->where('name', 'LIKE', "%$filterDep%")->get(['id', 'name'])->toArray();
    }

    public function storeAndReturnId(array $deparmentData)
    {
        $department = $this->departmentModel->newInstance();
        $department->name = $deparmentData['name'];
        $department->save();
        return $department->id;
    }

    public function getSingle(int $id)
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
