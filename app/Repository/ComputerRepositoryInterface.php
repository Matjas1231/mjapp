<?php
declare(strict_types=1);

namespace App\Repository;

interface ComputerRepositoryInterface
{
    public function all();
    public function get(int $id);
    public function storeAndReturnId(array $computerData);
}
