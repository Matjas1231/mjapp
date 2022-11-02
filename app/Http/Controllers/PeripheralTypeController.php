<?php

namespace App\Http\Controllers;

use App\Repository\PeripheralRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use Illuminate\Http\Request;

class PeripheralTypeController extends Controller
{
    public function __construct(
        private PeripheralTypeRepositoryInterface $peripheralTypeRepository,
        private PeripheralRepositoryInterface $peripheralRepository
        )
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

    public function searchPeripheralType(Request $request)
    {
        if ($request->ajax()) {
            $filtersArray = $this->prepareDataFromAjax($request->query());
            $result = $this->peripheralTypeRepository->searchPeripheralType($filtersArray);

            if (!$result) return response()->json(['message' => 'empty']);

            return response()->json($result);
        }
    }

    public function edit(int $typeId)
    {
        return view('peripheral.types.editType', [
            'peripheralType' => $this->peripheralTypeRepository->getSingle($typeId),
            'peripherals' => $this->peripheralRepository->peripheralsByType($typeId),
        ]);
    }

    public function create()
    {
        return view('peripheral.types.createType');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'string|max:60'
        ]);

        $this->peripheralTypeRepository->store($validatedData);

        return redirect()
                ->route('peripheral.type.list');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'string|max:60'
        ]);

        $this->peripheralTypeRepository->update($validatedData);

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
