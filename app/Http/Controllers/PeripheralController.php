<?php

namespace App\Http\Controllers;

use App\Repository\PeripheralRepositoryInterface;
use Illuminate\Http\Request;

class PeripheralController extends Controller
{
    private PeripheralRepositoryInterface $peripheralRepository;

    public function __construct(PeripheralRepositoryInterface $peripheralRepository)
    {
        $this->peripheralRepository = $peripheralRepository;
    }

    public function list()
    {
        return view('peripheral.list', [
            'peripherals' => $this->peripheralRepository->all(),
        ]);
    }
}
