<?php

namespace App\Http\Controllers;

use App\Repository\ComputerRepositoryInterface;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private ComputerRepositoryInterface $computerRepository;

    public function __construct(ComputerRepositoryInterface $computerRepository)
    {
        $this->computerRepository = $computerRepository;
    }

    public function list()
    {
        $computers = $this->computerRepository->all();

        return view('computer.list', ['computers' => $computers]);
    }

    public function show(int $computerId)
    {
        $computer = $this->computerRepository->get($computerId);
        return view('computer.show', ['computer' => $computer]);
    }
}
