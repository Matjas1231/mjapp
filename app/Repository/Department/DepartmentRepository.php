<?php
declare(strict_types=1);

namespace App\Repository\Department;

use App\Models\Department;
use App\Repository\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function departmentSearch(array $filters)
    {
        return $this->departmentModel->where('name', 'LIKE', "%{$filters['filterName']}%")->get(['id', 'name'])->toArray();
    }

    public function create(array $deparmentData)
    {
        $department = $this->departmentModel->newInstance();
        $department->fill($deparmentData);
        $department->save();
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

    public function getAllWithCountedWorkers()
    {
        return DB::table('departments')
                    ->select(['departments.name', DB::raw('COUNT(workers.id) as numbersOfWorkers')])
                    ->join('workers', 'departments.id', '=', 'workers.department_id')
                    ->groupBy('departments.name')
                    ->get();
    }
}
