<?php

namespace App\Http\Controllers;

use App\Http\Requests\Software\SoftwareRequest;
use App\Models\Software;
use App\Repository\SoftwareRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftwareController extends Controller
{
    public function __construct(
        private SoftwareRepositoryInterface $softwareRepository,
        private WorkerRepositoryInterface $workerRepository
        )
    {
        $this->softwareRepository = $softwareRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list(Request $request)
    {
        if (!empty($request->query())) {
            $filters = [];
            $filters['filter'] = $request->filter ?? null;
            $filters['producer'] = $request->producer ?? null;
            $filters['name'] = $request->name ?? null;
            $filters['serialnumber'] = $request->serialnumber ?? null;

            $softwares = $this->softwareRepository->filterBy($filters);
        } else {
            $softwares = $this->softwareRepository->all();
        }
        return view('software.list', [
            'softwares' => $softwares,
            'filter' => $filters['filter'] ?? null,
            'producer' => $filters['producer'] ?? null,
            'name' => $filters['name'] ?? null,
            'serialNumber' => $filters['serialnumber'] ?? null,
        ]);
    }

    public function searchSoftware(Request $request)
    {
        if ($request->ajax()) {
            $filtersArray = $this->prepareDataFromAjax($request->query());

            $result = $this->softwareRepository->searchSoftware($filtersArray);

            return response()->json($result);
        }
    }

    public function show(int $id)
    {
        return view('software.show', [
            'software' => $this->softwareRepository->getSoftware($id),
        ]);
    }

    public function create()
    {
        return view('software.create', [
            'workers' => $this->workerRepository->allWithoutPaginate(),
        ]);
    }

    public function store(SoftwareRequest $request)
    {
        $id = $this->softwareRepository->storeAndReturnId($request->validated());
        return redirect()
                ->route('software.show', ['softwareId' => $id]);
    }

    public function edit(int $id)
    {
        return view('software.edit', [
            'software' => $this->softwareRepository->getSoftware($id),
            'workers' => $this->workerRepository->allWithoutPaginate(),
        ]);
    }

    public function update(SoftwareRequest $request)
    {
        $this->softwareRepository->update($request->validated());
        return redirect()
                ->route('software.show', ['softwareId' => $request['id']]);
    }

    public function delete(int $id)
    {
        $this->softwareRepository->delete($id);

        return redirect()
                ->route('software.list');
    }
}
