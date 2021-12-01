<?php
declare(strict_types=1);

namespace App\Repository\Computer;

use App\Models\Computer;
use App\Repository\ComputerRepositoryInterface;

class ComputerRepository implements ComputerRepositoryInterface
{
    private Computer $computerModel;

    public function __construct(Computer $computerModel)
    {
        $this->computerModel = $computerModel;
    }

    public function all()
    {
        return $this->computerModel->get();
    }

    public function get(int $id)
    {
        return $this->computerModel->find($id);
    }
}
