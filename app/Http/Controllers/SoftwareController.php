<?php

namespace App\Http\Controllers;

use App\Repository\SoftwareRepositoryInterface;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    private SoftwareRepositoryInterface $softwareRepository;

    public function __construct(SoftwareRepositoryInterface $softwareRepository)
    {
        $this->softwareRepository = $softwareRepository;
    }

    public function list()
    {
        return view('software.list', [
            'softwares' => $this->softwareRepository->all(),
        ]);
    }

    public function show(int $id)
    {
        $this->softwareRepository->getSoftware($id);

    }
}
