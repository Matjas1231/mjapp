<?php
declare(strict_types=1);

namespace App\Repository;

interface ComputerTypeRepositoryInterface
{
    public function all();
    public function store(array $computerTypeData);
    public function delete(int $computerTypeId);
    public function getComputerType(int $computerTypeId);
    public function update(array $computerTypeId);
}
