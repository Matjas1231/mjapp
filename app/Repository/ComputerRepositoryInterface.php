<?php
declare(strict_types=1);

namespace App\Repository;

interface ComputerRepositoryInterface
{
    public function all();
    public function filterBy(?array $filters);
    public function searchComputer(array $filters);
    public function computerWithoutWorker();
    public function getComputer(int $id);
    public function computersByType(int $typeId);
    public function storeAndReturnId(array $computerData);
    public function update(array $computerData);
    public function delete(int $id);
    public function countComputers();
}
