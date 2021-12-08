<?php

namespace App\Http\Controllers;

use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    private WorkerRepositoryInterface $workerRepository;
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(WorkerRepositoryInterface $workerRepository, DepartmentRepositoryInterface $departmentRepository)
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function list()
    {
        $workers = $this->workerRepository->all();
        return view('worker.list', ['workers' => $workers]);
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

    public function store(Request $request)
    {
        $workerData = $request->input();
        $workerId = $this->workerRepository->storeAndReturnId($workerData);


        return redirect()
                ->route('worker.show', ['workerId' => $workerId]);
    }

    public function edit(int $workerId)
    {
        $worker = $this->workerRepository->getWorker($workerId);
        $departments = $this->departmentRepository->all();
        return view('worker.edit', ['worker' => $worker, 'departments' => $departments]);
    }

    public function update(Request $request)
    {
        $workerData = $request->input();
        $this->workerRepository->update($workerData);

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
