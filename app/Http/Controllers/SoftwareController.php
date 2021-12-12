<?php

namespace App\Http\Controllers;

use App\Repository\SoftwareRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    private SoftwareRepositoryInterface $softwareRepository;
    private WorkerRepositoryInterface $workerRepository;

    public function __construct(SoftwareRepositoryInterface $softwareRepository, WorkerRepositoryInterface $workerRepository)
    {
        $this->softwareRepository = $softwareRepository;
        $this->workerRepository = $workerRepository;
    }

    public function list()
    {
        return view('software.list', [
            'softwares' => $this->softwareRepository->all(),
        ]);
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

    public function store(Request $request)
    {
        $id = $this->softwareRepository->storeAndReturnId($request->input());
        return redirect()
                ->route('software.show', ['softwareId' => $id]);
    }

    public function edit(int $id)
    {
        return view('software.edit', [
            'software' => $this->softwareRepository->getSoftware($id),
            'workers' => $this->workerRepository->all(),
        ]);
    }

    public function update(Request $request)
    {
        $this->softwareRepository->update($request->input());
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
