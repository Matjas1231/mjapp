<?php

namespace App\Http\Controllers;

use App\Repository\PeripheralRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class PeripheralController extends Controller
{
    private PeripheralRepositoryInterface $peripheralRepository;
    private PeripheralTypeRepositoryInterface $peripheralTypeRepostiory;
    private WorkerRepositoryInterface $workerRepository;

    public function __construct(PeripheralRepositoryInterface $peripheralRepository, WorkerRepositoryInterface $workerRepository, PeripheralTypeRepositoryInterface $peripheralTypeRepostiory)
    {
        $this->peripheralRepository = $peripheralRepository;
        $this->workerRepository = $workerRepository;
        $this->peripheralTypeRepostiory = $peripheralTypeRepostiory;
    }

    public function list()
    {
        return view('peripheral.list', [
            'peripherals' => $this->peripheralRepository->all(),
        ]);
    }

    public function show(int $peripheralId)
    {
        return view('peripheral.show', [
            'peripheral' => $this->peripheralRepository->getPeripheral($peripheralId)
        ]);
    }

    public function create()
    {
        return view('peripheral.create', [
            'peripheralTypes' => $this->peripheralTypeRepostiory->all(),
            'workers' => $this->workerRepository->all(),
        ]);
    }

    public function store(Request $request)
    {
        $newPeripheralId = $this->peripheralRepository->storeAndReturnId($request->input());

        return redirect()
                ->route('peripheral.show', ['peripheralId' => $newPeripheralId]);
    }

    public function edit(int $peripheralId)
    {
        return view('peripheral.edit', [
            'peripheral' => $this->peripheralRepository->getPeripheral($peripheralId),
            'workers' => $this->workerRepository->all(),
            'types' => $this->peripheralTypeRepostiory->all(),
        ]);
    }

    public function update(Request $request)
    {
        $this->peripheralRepository->update($request->input());

        return redirect()
                ->route('peripheral.show', ['peripheralId' => $request->id]);
    }

    public function delete(int $id)
    {
        $this->peripheralRepository->delete($id);
        return redirect()
                ->route('peripheral.list');
    }
}
