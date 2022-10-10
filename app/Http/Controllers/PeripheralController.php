<?php

namespace App\Http\Controllers;

use App\Http\Requests\Peripheral\PeripheralRequest;
use App\Repository\PeripheralRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class PeripheralController extends Controller
{
    public function __construct(
        private PeripheralRepositoryInterface $peripheralRepository,
        private WorkerRepositoryInterface $workerRepository,
        private PeripheralTypeRepositoryInterface $peripheralTypeRepostiory
        )
    {
        $this->peripheralRepository = $peripheralRepository;
        $this->workerRepository = $workerRepository;
        $this->peripheralTypeRepostiory = $peripheralTypeRepostiory;
    }

    public function list()
    {
        return view('peripheral.list', [
            'peripherals' => $this->peripheralRepository->all()
        ]);
    }

    public function searchPeripheral(Request $request)
    {
        if ($request->ajax()) {
            $filtersArray = $this->prepareDataFromAjax($request->query());
            $result = $this->peripheralRepository->searchPeripheral($filtersArray);

            return response()->json($result);
        }
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

    public function store(PeripheralRequest $request)
    {
        $newPeripheralId = $this->peripheralRepository->storeAndReturnId($request->validated());

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

    public function update(PeripheralRequest $request)
    {
        $this->peripheralRepository->update($request->validated());

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
