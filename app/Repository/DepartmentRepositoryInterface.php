<?php
declare(strict_types=1);

namespace App\Repository;

interface DepartmentRepositoryInterface
{
    public function all();
    public function departmentSearch(array $filters);
    public function getSingle(int $id);
    public function create(array $peripheralData);
    public function update(array $peripheralData);
    public function delete(int $id);
    public function getAllWithCountedWorkers();
}
