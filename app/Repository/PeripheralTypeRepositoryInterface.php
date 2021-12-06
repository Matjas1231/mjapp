<?php
declare(strict_types=1);

namespace App\Repository;

interface PeripheralTypeRepositoryInterface
{
    public function all();
    public function getSingle(int $id);
    public function store(array $peripheralData);
    public function update(array $peripheralData);
    public function delete(int $id);
}
