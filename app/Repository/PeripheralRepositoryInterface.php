<?php
declare(strict_types=1);

namespace App\Repository;

interface PeripheralRepositoryInterface
{
    public function all();
    public function getPeripheral(int $id);
    public function storeAndReturnId(array $peripheralData);
    public function update(array $peripheralData);
    public function delete(int $id);
}
