<?php

namespace App\Http\Controllers;

use App\Repository\PeripheralRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use Illuminate\Http\Request;

class PeripheralTypeController extends Controller
{
    private PeripheralTypeRepositoryInterface $peripheralTypeRepository;
    private PeripheralRepositoryInterface $peripheralRepository;

    public function __construct(PeripheralTypeRepositoryInterface $peripheralTypeRepository, PeripheralRepositoryInterface $peripheralRepository)
    {
        $this->peripheralTypeRepository = $peripheralTypeRepository;
        $this->peripheralRepository = $peripheralRepository;
    }
    public function list()
    {
        return view('peripheral.types.listType', [
            'peripheralTypes' => $this->peripheralTypeRepository->all()
        ]);
    }

    public function edit(int $id)
    {
        return view('peripheral.types.editType', [
            'peripheralType' => $this->peripheralTypeRepository->getSingle($id),
            'peripherals' => $this->peripheralRepository->all(),
        ]);
    }

    public function create()
    {
        return view('peripheral.types.createType');
    }

    public function store(Request $request)
    {
        $this->peripheralTypeRepository->store($request->input());

        return redirect()
                ->route('peripheral.type.list');
    }

    public function update(Request $request)
    {
        $this->peripheralTypeRepository->update($request->input());

        return redirect()
                ->route('peripheral.type.list');
    }

    public function delete(int $id)
    {
        $this->peripheralTypeRepository->delete($id);

        return redirect()
                ->route('peripheral.type.list');
    }
}
