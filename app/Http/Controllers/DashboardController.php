<?php

namespace App\Http\Controllers;

use App\Repository\ComputerRepositoryInterface;
use App\Repository\ComputerTypeRepositoryInterface;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\PeripheralTypeRepositoryInterface;
use App\Repository\SoftwareRepositoryInterface;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private WorkerRepositoryInterface $workerRepository,
        private DepartmentRepositoryInterface $departmentRepository,
        private ComputerRepositoryInterface $computerRepository,
        private SoftwareRepositoryInterface $softwareRepository,
        private ComputerTypeRepositoryInterface $computerTypeRepository,
        private PeripheralTypeRepositoryInterface $peripheralTypeRepository,
        private CurrencyRepositoryInterface $currencyRepository
        )
    {
        $this->workerRepository = $workerRepository;
        $this->departmentRepository = $departmentRepository;
        $this->computerRepository = $computerRepository;
        $this->softwareRepository = $softwareRepository;
        $this->computerTypeRepository = $computerTypeRepository;
        $this->peripheralTypeRepository = $peripheralTypeRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function dashboard()
    {
        return view('dashboard', [
            'countWorkers' => $this->workerRepository->countWorkers(),
            'countDepartments' => $this->departmentRepository->all()->count(),
            'departmentsWithCountedWorkers' => $this->departmentRepository->getAllWithCountedWorkers(),
            'countComputers' => $this->computerRepository->countComputers(),
            'computerTypesWithCountedComputers' => $this->computerTypeRepository->getAllWithCountedComputers(),
            'peripheralTypesWithCountedDevices' => $this->peripheralTypeRepository->getAllWithCountedDevices(),
            'countSoftwares' => $this->softwareRepository->countSoftwares(),
            'lastCurrencyDownload' => $this->currencyRepository->getlatest(),
        ]);
    }
}
