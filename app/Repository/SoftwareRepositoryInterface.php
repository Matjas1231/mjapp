<?php
declare(strict_types=1);

namespace App\Repository;


interface SoftwareRepositoryInterface
{
    public function all();
    public function filterBy(?array $filters);
    public function searchSoftware(array $filters);
    public function getSoftware(int $id);
    public function storeAndReturnId(array $peripheralData);
    public function update(array $peripheralData);
    public function delete(int $id);
    public function countSoftwares();
}
