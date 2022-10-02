<?php

namespace App\Http\Controllers;

use App\Http\Requests\Worker\WorkerRequest;
use App\Models\Department;
use App\Models\Worker;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class WorkerController extends Controller
{
    public function __construct(
        private WorkerRepositoryInterface $workerRepository,
        private DepartmentRepositoryInterface $departmentRepository
        )
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function list()
    {
        return view('worker.list', [
            'workers' => $this->workerRepository->all()
        ]);
    }

    public function searchWorker(Request $request)
    {
        if ($request->ajax()) {
            $filterName = $request->input('filterName') ?? null;
            $filterDep = $request->input('filterDep') ?? null;

            $result = $this->workerRepository->workerSearch($filterName, $filterDep);

            return response()->json($result);
        }
    }

    public function show(int $workerId)
    {
        $worker = $this->workerRepository->getWorker($workerId);
        return view('worker.show', ['worker' => $worker]);
    }

    public function create()
    {
        return view('worker.create', [
            'departments' => $this->departmentRepository->all()
        ]);
    }

    public function store(WorkerRequest $request)
    {
        $workerId = $this->workerRepository->storeAndReturnId($request->validated());


        return redirect()
                ->route('worker.show', ['workerId' => $workerId]);
    }

    public function edit(int $workerId)
    {
        $worker = $this->workerRepository->getWorker($workerId);
        $departments = $this->departmentRepository->all();
        return view('worker.edit', ['worker' => $worker, 'departments' => $departments]);
    }

    public function update(WorkerRequest $request)
    {
        $this->workerRepository->update($request->validated());

        return redirect()
                ->route('worker.show',['workerId' => $request['id']]);
    }

    public function delete(int $workerId)
    {
        $this->workerRepository->delete($workerId);

        return redirect()
                ->route('worker.list');
    }
}
