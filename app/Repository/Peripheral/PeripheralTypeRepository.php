<?php
declare(strict_types=1);

namespace App\Repository\Peripheral;

use App\Models\PeripheralType;
use App\Repository\PeripheralTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function searchPeripheralType(array $filters)
    {
        return $this->peripheralTypeModel->where('type', 'LIKE', "%{$filters['filterName']}%")->get(['id', 'type as name'])->toArray();
    }

    public function getSingle(int $id)
    {
        return $this->peripheralTypeModel->find($id);
    }

    public function store(array $peripheralTypeData)
    {
        $peripheralType = $this->peripheralTypeModel->newInstance();
        $peripheralType->type = $peripheralTypeData['type'];

        return $peripheralType->save();
    }

    public function update(array $peripheralTypeData)
    {
        $peripheralType = $this->peripheralTypeModel->find($peripheralTypeData['id']);
        $peripheralType->type = $peripheralTypeData['type'];

        return $peripheralType->save();
    }

    public function delete(int $id)
    {
        return $this->peripheralTypeModel->find($id)->delete();
    }

    public function getAllWithCountedDevices()
    {
        return DB::table('peripheral_types')
                    ->select(['peripheral_types.type', DB::raw('COUNT(peripherals.id) as numbersOfDevices')])
                    ->join('peripherals', 'peripheral_types.id', '=', 'peripherals.type_id')
                    ->groupBy('peripheral_types.type')
                    ->get();
    }
}
