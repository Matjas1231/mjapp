<?php

namespace App\Http\Controllers;

use App\Repository\ComputerRepositoryInterface;
use App\Repository\ComputerTypeRepositoryInterface;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use App\Repository\SoftwareRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private WorkerRepositoryInterface $workerRepository;
    private DepartmentRepositoryInterface $departmentRepository;
    private ComputerRepositoryInterface $computerRepository;
    private SoftwareRepositoryInterface $softwareRepository;
    private ComputerTypeRepositoryInterface $computerTypeRepository;
    private PeripheralTypeRepositoryInterface $peripheralTypeRepository;

    public function __construct(WorkerRepositoryInterface $workerRepository,
                                DepartmentRepositoryInterface $departmentRepository,
                                ComputerRepositoryInterface $computerRepository,
                                SoftwareRepositoryInterface $softwareRepository,
                                ComputerTypeRepositoryInterface $computerTypeRepository,
                                PeripheralTypeRepositoryInterface $peripheralTypeRepository)
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
        $this->computerRepository = $computerRepository;
        $this->softwareRepository = $softwareRepository;
        $this->computerTypeRepository = $computerTypeRepository;
        $this->peripheralTypeRepository = $peripheralTypeRepository;
    }

    public function dashboard()
    {
        $countWorkers = $this->workerRepository->countWorkers();

        $departments = $this->departmentRepository->all();

        $countComputers = $this->computerRepository->countComputers();
        $computerTypes = $this->computerTypeRepository->all();

        $peripheralTypes = $this->peripheralTypeRepository->all();

        $countSoftwares = $this->softwareRepository->countSoftwares();


        return view('dashboard', [
            'countWorkers' => $countWorkers,
            'countDepartments' => $departments->count(),
            'departments' => $departments,
            'countComputers' => $countComputers,
            'computerTypes' => $computerTypes,
            'peripheralTypes' => $peripheralTypes,
            'countSoftwares' => $countSoftwares,
        ]);
    }
}
