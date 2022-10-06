<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository,
        private WorkerRepositoryInterface $workerRepository
        )
    {
        $this->departmentRepository = $departmentRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        return view('department.list', ['departments' => $this->departmentRepository->all()]);
    }

    public function searchDepartment(Request $request)
    {
        if ($request->ajax()) {
            $filterDep = $request->query('filterDep');
            $result = $this->departmentRepository->departmentSearch($filterDep);

            return response()->json($result);
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validatedData = $request->validate([
                'name' => 'string|max:100'
            ]);

            $departmentId = $this->departmentRepository->storeAndReturnId($validatedData);
            return response()->json($departmentId);
        }
    }

    public function edit(int $departmentId)
    {
        return view('department.edit', [
            'department' => $this->departmentRepository->getSingle($departmentId),
            'workers' => $this->workerRepository->workersByDepartment($departmentId),
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'integer|unique:departments,id',
            'name' => 'string|max:100'
        ]);

        $this->departmentRepository->update($validatedData);
        return redirect()
                ->route('department.edit', ['departmentId' => $request['id']]);
    }

    public function delete(int $id)
    {
        $this->departmentRepository->delete($id);
        return redirect()
                ->route('department.list');
    }
}
