<?php

namespace App\Http\Controllers;

use App\Repository\ComputerRepositoryInterface;
use App\Repository\ComputerTypeRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private ComputerRepositoryInterface $computerRepository;
    private ComputerTypeRepositoryInterface $computerTypeRepostiory;
    private WorkerRepositoryInterface $workerRepository;

    public function __construct(ComputerRepositoryInterface $computerRepository, ComputerTypeRepositoryInterface $computerTypeRepository, WorkerRepositoryInterface $workerRepository)
    {
        $this->computerRepository = $computerRepository;
        $this->computerTypeRepostiory = $computerTypeRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        $computers = $this->computerRepository->all();

        return view('computer.list', ['computers' => $computers]);
    }

    public function show(int $computerId)
    {
        $computer = $this->computerRepository->get($computerId);
        return view('computer.show', ['computer' => $computer]);
    }

    public function create()
    {
        return view('computer.create', [
                        'types' => $this->computerTypeRepostiory->all(),
                        'workers' => $this->workerRepository->all()
                ]
            );
    }

    public function store(Request $request)
    {
        $this->computerRepository->storeAndReturnId($request->input());
        return redirect()
                ->route('computer.show', [
                    'computerId' => $this->computerRepository->storeAndReturnId($request->input())
                    ]
                );
    }
}
