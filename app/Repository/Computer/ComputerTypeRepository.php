<?php
declare(strict_types=1);

namespace App\Repository\Computer;

use App\Models\ComputerTypes;
use App\Repository\ComputerTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ComputerTypeRepository implements ComputerTypeRepositoryInterface
{
    private ComputerTypes $computerTypeModel;

    public function __construct(ComputerTypes $computerTypeModel)
    {
        $this->computerTypeModel = $computerTypeModel;
    }

    public function all()
    {
        return $this->computerTypeModel->all();
    }

    public function searchComputerType(array $filters)
    {
        return $this->computerTypeModel->where('type', 'LIKE', "%{$filters['filterName']}%")->get(['id', 'type as name'])->toArray();
    }

    public function store(array $computerTypeData)
    {
        $computerType = $this->computerTypeModel->newInstance();
        $computerType->type = $computerTypeData['type'];
        return $computerType->save();
    }

    public function getSingle(int $computerTypeId)
    {
        return $this->computerTypeModel->with('computers')->find($computerTypeId);
    }

    public function update(array $computerData)
    {
        $computerType = $this->computerTypeModel->find($computerData['id']);
        $computerType['type'] = $computerData['type'];

        return $computerType->save();
    }

    public function delete(int $computerTypeid)
    {
        $computerType = $this->computerTypeModel->find($computerTypeid);
        return $computerType->delete();
    }

    public function getAllWithCountedComputers()
    {
        return DB::table('computer_types')
            ->select(['computer_types.type', DB::raw('COUNT(computers.id) as numbersOfComputers')])
            ->join('computers', 'computer_types.id', '=', 'computers.type_id')
            ->groupBy('computer_types.type')
            ->get();
    }
}
