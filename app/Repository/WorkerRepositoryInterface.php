<?php
declare(strict_types=1);

namespace App\Repository;

interface WorkerRepositoryInterface
{
    public function all();
    public function getWorker(int $id);
    public function saveAndReturnId(array $workerData);
    public function update(array $workerData);
    public function delete(int $id);
}
