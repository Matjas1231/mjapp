<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;
    private WorkerRepositoryInterface $workerRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository, WorkerRepositoryInterface $workerRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        return view('department.list', ['departments' => $this->departmentRepository->all()]);
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $this->departmentRepository->store($request->input());
        return redirect()
                ->route('department.list');
    }

    public function edit(int $departmentId)
    {
        return view('department.edit', [
            'department' => $this->departmentRepository->getDepartment($departmentId),
            'workers' => $this->workerRepository->all(),
        ]);
    }

    public function update(Request $request)
    {
        $this->departmentRepository->update($request->input());
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
