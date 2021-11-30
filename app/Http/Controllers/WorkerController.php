<?php

namespace App\Http\Controllers;

use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    private WorkerRepositoryInterface $workerRepository;

    public function __construct(WorkerRepositoryInterface $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        $workers = $this->workerRepository->all();
        return view('worker.list', ['workers' => $workers]);
    }

    public function show(int $workerId)
    {
        $worker = $this->workerRepository->get($workerId);

        return view('worker.show', ['worker' => $worker]);
    }
}
