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

    public function list(Request $request)
    {
        if (!empty($request->query())) {
            $filters = [];
            $filters['filter'] = $request->filter ?? null;
            $filters['peripheraltype'] = $request->peripheraltype ?? null;
            $filters['brand'] = $request->brand ?? null;
            $filters['model'] = $request->model ?? null;
            $filters['serialnumber'] = $request->serialnumber ?? null;
            $filters['ipaddress'] = $request->ipaddress ?? null;
            $filters['macaddress'] = $request->macaddress ?? null;
            $filters['networkname'] = $request->networkname ?? null;

            $peripherals = $this->peripheralRepository->filterBy($filters);
        } else {
            $peripherals = $this->peripheralRepository->all();
        }
        return view('peripheral.list', [
            'peripherals' => $peripherals,
            'filter' => $filters['filter'] ?? null,
            'peripheralType' => $filters['peripheraltype'] ?? null,
            'brand' => $filters['brand'] ?? null,
            'model' => $filters['model'] ?? null,
            'serialNumber' => $filters['serialnumber'] ?? null,
            'ipaddress' => $filters['ipaddress'] ?? null,
            'macaddress' => $filters['macaddress'] ?? null,
            'networkName' => $filters['networkname'] ?? null,
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
            'workers' => $this->workerRepository->allWithoutPaginate(),
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
            'workers' => $this->workerRepository->allWithoutPaginate(),
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
