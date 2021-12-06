<?php
declare(strict_types=1);

namespace App\Repository;

interface ComputerRepositoryInterface
{
    public function all();
    public function getComputer(int $id);
    public function storeAndReturnId(array $computerData);
    public function update(array $computerData);
    public function delete(int $id);
}
