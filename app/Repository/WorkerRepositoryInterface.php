<?php
declare(strict_types=1);

namespace App\Repository;

interface WorkerRepositoryInterface
{
    public function all();
    public function allWithoutPaginate();
    public function workerSearch(?string $filterName = null, ?string $filterDep = null);
    public function getWorker(int $id);
    public function storeAndReturnId(array $workerData);
    public function update(array $workerData);
    public function delete(int $id);
    public function countWorkers();
    public function workersByDepartment(int $departmentId);
}
