<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function __construct(
        private WorkerRepositoryInterface $workerRepository,
        private DepartmentRepositoryInterface $departmentRepository
        )
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function list(Request $request)
    {
        if (!empty($request->query())) {
            $filters = [];
            $filters['filter']  = $request->filter ?? null;
            // $filters['filterSurname']  = $request->filtersurname ?? null;
            $filters['filterDeb']  = $request->filterdeb ?? null;
            $workers = $this->workerRepository->filterBy($filters);
        } else {
            $workers = $this->workerRepository->all();
        }


        return view('worker.list', [
            'workers' => $workers,
            'filter' => $filters['filter'] ?? null,
            // 'filterSurname' => $filters['filterSurname'] ?? null,
            'filterDeb' => $filters['filterDeb'] ?? null,
        ]);
    }

    public function ajaxList(Request $request)
    {
        $filter = $request->get('filter');
        $filterDep = $request->get('filterDep');
        // $workers = Worker::where('name', 'LIKE', "%$filter%")
        //                     // ->orWhere('surname', 'like', "%$filter%")
        //                     ->with('department')
        //                     ->get()
        //                     ->filter(function($q) use($filterDep) {
        //                         if(!is_null($q->department->name) > 0) {
        //                             $name = $q->department->name;
        //                             $resultName = Str::contains($name, $filterDep);
        //                             return $resultName;
        //                         }

        //                     });
                            // dd($workers);


        $workers = Worker::where('name', 'LIKE', "%$filter%")
                            ->orWhere('surname', 'like', "%$filter%")
                            ->with('department')
                            // ->paginate(2);
                            ->get();

        return response()->json($workers);
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
