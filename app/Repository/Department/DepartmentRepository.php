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
}
