<?php
declare(strict_types=1);

namespace App\Repository\Peripheral;

use App\Models\Peripheral;
use App\Repository\PeripheralRepositoryInterface;

class PeripheralRepository implements PeripheralRepositoryInterface
{
    private Peripheral $peripheralModel;

    public function __construct(Peripheral $peripheralModel)
    {
        $this->peripheralModel = $peripheralModel;
    }

    public function all()
    {
        return $this->peripheralModel->get();
    }

    public function getPeripheral(int $id)
    {
        return $this->peripheralModel->find($id);
    }

    public function storeAndReturnId(array $peripheralData)
    {

    }

    public function update(array $peripheralData)
    {

    }

    public function delete(int $id)
    {

    }
}
