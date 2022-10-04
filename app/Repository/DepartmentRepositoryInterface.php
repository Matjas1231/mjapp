<?php
declare(strict_types=1);

namespace App\Repository;

interface DepartmentRepositoryInterface
{
    public function all();
    public function departmentSearch(?string $filterDep = null);
    public function getSingle(int $id);
    public function storeAndReturnId(array $peripheralData);
    public function update(array $peripheralData);
    public function delete(int $id);
}
