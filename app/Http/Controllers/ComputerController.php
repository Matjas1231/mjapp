<?php

namespace App\Http\Controllers;

use App\Http\Requests\Computer\ComputerRequest;
use App\Repository\ComputerRepositoryInterface;
use App\Repository\ComputerTypeRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function __construct(
        private ComputerRepositoryInterface $computerRepository,
        private ComputerTypeRepositoryInterface $computerTypeRepository,
        private WorkerRepositoryInterface $workerRepository
    )
    {
        $this->computerRepository = $computerRepository;
        $this->computerTypeRepostiory = $computerTypeRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        return view('computer.list', [
            'computers' => $this->computerRepository->all(),
        ]);
    }

    public function searchComputer(Request $request)
    {
        if ($request->ajax()) {
            if ($request->query('filterWithoutWorker')) {
                $result = $this->computerRepository->computerWithoutWorker();
                if (!$result) return response()->json(['message' => 'empty']);
                return $result;
            }

            $filtersArray = $this->prepareDataFromAjax($request->query());
            $result = $this->computerRepository->searchComputer($filtersArray);
            if (!$result) return response()->json(['message' => 'empty']);

            return response()->json($result);
        }
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

    public function update(ComputerRequest $request)
    {
        $this->computerRepository->update($request->validated());


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

    public function store(ComputerRequest $request)
    {
        $computerId = $this->computerRepository->storeAndReturnId($request->validated());

        return redirect()
                ->route('computer.show', [
                    'computerId' => $computerId
                    ]);
    }

    public function delete(int $id)
    {
        $this->computerRepository->delete($id);
        return redirect()
                ->route('computer.list');
    }
}
