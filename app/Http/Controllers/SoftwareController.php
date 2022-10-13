<?php

namespace App\Http\Controllers;

use App\Http\Requests\Software\SoftwareRequest;
use App\Repository\SoftwareRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

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

    public function list()
    {
        return view('software.list', [
            'softwares' => $this->softwareRepository->all()
        ]);
    }

    public function searchSoftware(Request $request)
    {
        if ($request->ajax()) {
            if ($request->query('filterWithoutWorker')) {
                return $this->softwareRepository->softwareWithoutWorker();
            }

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
