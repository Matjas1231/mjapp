<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;

class WorkerController extends Controller
{
    private WorkerRepositoryInterface $workerRepository;
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(WorkerRepositoryInterface $workerRepository, DepartmentRepositoryInterface $departmentRepository)
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function list(Request $request)
    {
        $phraseName = $request->get('phraseName') ?? '';

        $workers = $this->workerRepository->filterBy($phraseName);
        return view('worker.list', [
            'workers' => $workers,
            'phraseName' => $phraseName ?? '',
        ]);
    }

    public function ajaxList(Request $request)
    {
        $filter = $request->get('filter');
        $filterDep = $request->get('filterDep');
        // $workers = Worker::where('name', 'LIKE', "%$filter%")
        $workers = Worker::where('name', 'LIKE', "%$filter%")
                            // ->orWhere('surname', 'like', "%$filter%")
                            ->with('department')
                            ->get()
                            ->filter(function($q) use($filterDep) {
                                if(!is_null($q->department->name) > 0) {
                                    $name = $q->department->name;
                                    $resultName = Str::contains($name, $filterDep);
                                    return $resultName;
                                }

                            });
                            // dd($workers);


        return response()->json(['workers' => $workers]);
    }

    public function show(int $workerId)
    {
        $worker = $this->workerRepository->getWorker($workerId);
        return view('worker.show', ['worker' => $worker]);
    }

    public function create()
    {
        return view('worker.create', [
            'departments' => $this->departmentRepository->all()
        ]);
    }

    public function store(Request $request)
    {
        $workerData = $request->input();
        $workerId = $this->workerRepository->storeAndReturnId($workerData);


        return redirect()
                ->route('worker.show', ['workerId' => $workerId]);
    }

    public function edit(int $workerId)
    {
        $worker = $this->workerRepository->getWorker($workerId);
        $departments = $this->departmentRepository->all();
        return view('worker.edit', ['worker' => $worker, 'departments' => $departments]);
    }

    public function update(Request $request)
    {
        $workerData = $request->input();
        $this->workerRepository->update($workerData);

        return redirect()
                ->route('worker.show',['workerId' => $request['id']]);
    }

    public function delete(int $workerId)
    {
        $this->workerRepository->delete($workerId);

        return redirect()
                ->route('worker.list');
    }
}
