<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
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
        return view('department.edit', ['department' => $this->departmentRepository->getDepartment($departmentId)]);
    }

    public function update(Request $request)
    {
        $this->departmentRepository->update($request->input());
        return redirect()
                ->route('department.list');
    }

    public function delete(int $id)
    {
        $this->departmentRepository->delete($id);
        return redirect()
                ->route('department.list');
    }
}
