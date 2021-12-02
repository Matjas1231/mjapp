<?php

namespace App\Http\Controllers;

use App\Repository\ComputerTypeRepositoryInterface;
use Illuminate\Http\Request;

class ComputerTypesController extends Controller
{
    private ComputerTypeRepositoryInterface $computerTypeRepository;

    public function __construct(ComputerTypeRepositoryInterface $computerTypeRepository)
    {
        $this->computerTypeRepository = $computerTypeRepository;
    }

    public function list()
    {
        return view('computer.types.listType', ['computerTypes' => $this->computerTypeRepository->all()]);
    }


    public function edit(int $computerTypeId)
    {
        $computerType = $this->computerTypeRepository->getComputerType($computerTypeId);

        return view('computer.types.editType', ['computerType' => $computerType]);
    }

    public function create()
    {
        return view('computer.types.createType');
    }

    public function store(Request $request)
    {
        $this->computerTypeRepository->store($request->input());
        return redirect()
                ->route('computer.type.list');
    }

    public function update(Request $request)
    {
        $this->computerTypeRepository->update($request->input());
        return redirect()
                ->route('computer.type.edit', ['computerTypeId' => $request['id']]);
    }

    public function delete(int $id)
    {
        $this->computerTypeRepository->delete($id);

        return redirect()
                ->route('computer.type.list');
    }
}
