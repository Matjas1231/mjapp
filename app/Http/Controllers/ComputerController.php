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

    public function list(Request $request)
    {
        if (!empty($request->query())) {
            $filters = [];
            $filters['filter'] = $request->filter ?? null;
            $filters['computertype'] = $request->computertype ?? null;
            $filters['brand'] = $request->brand ?? null;
            $filters['model'] = $request->model ?? null;
            $filters['serialnumber'] = $request->serialnumber ?? null;
            $filters['ipaddress'] = $request->ipaddress ?? null;
            $filters['macaddress'] = $request->macaddress ?? null;
            $filters['computername'] = $request->computername ?? null;

            // dd($filters);
            $computers = $this->computerRepository->filterBy($filters);
        } else {
            $computers = $this->computerRepository->all();
        }

        return view('computer.list', [
            'computers' => $computers,
            'filter' => $filters['filter'] ?? null,
            'computertype' => $filters['computertype'] ?? null,
            'brand' => $filters['brand'] ?? null,
            'model' => $filters['model'] ?? null,
            'serialnumber' => $filters['serialnumber'] ?? null,
            'ipaddress' => $filters['ipaddress'] ?? null,
            'macaddress' => $filters['macaddress'] ?? null,
            'computername' => $filters['computername'] ?? null,
        ]);
    }

    public function show(int $computerId)
    {
        $computer = $this->computerRepository->getComputer($computerId);
        return view('computer.show', ['computer' => $computer]);
    }

    public function edit(int $computerId)
    {
        return view('computer.edit', [
            'computer' => $this->computerRepository->getComputer($computerId),
            'workers' => $this->workerRepository->allWithoutPaginate(),
            'types' => $this->computerTypeRepostiory->all(),
        ]);
    }

    public function update(Request $request)
    {
        $this->computerRepository->update($request->input());

        return redirect()
                ->route('computer.show', ['computerId' => $request['id']]);
    }

    public function create()
    {
        return view('computer.create', [
                        'types' => $this->computerTypeRepostiory->all(),
                        'workers' => $this->workerRepository->all()
                ]);
    }

    public function store(Request $request)
    {
        $this->computerRepository->storeAndReturnId($request->input());
        return redirect()
                ->route('computer.show', [
                    'computerId' => $this->computerRepository->storeAndReturnId($request->input())
                    ]);
    }

    public function delete(int $id)
    {
        $this->computerRepository->delete($id);
        return redirect()
                ->route('computer.list');
    }
}
