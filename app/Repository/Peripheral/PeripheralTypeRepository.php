<?php
declare(strict_types=1);

namespace App\Repository\Peripheral;

use App\Models\PeripheralType;
use App\Repository\PeripheralTypeRepositoryInterface;

class PeripheralTypeRepository implements PeripheralTypeRepositoryInterface
{
    private PeripheralType $peripheralTypeModel;

    public function __construct(PeripheralType $peripheralTypeModel)
    {
        $this->peripheralTypeModel = $peripheralTypeModel;
    }

    public function all()
    {
        return $this->peripheralTypeModel->get();
    }

    public function getSingle(int $id)
    {

    }

    public function store(array $peripheralTypeData)
    {

    }

    public function update(array $peripheralTypeData)
    {

    }

    public function delete(int $id)
    {

    }
}
