<?php
declare(strict_types=1);

namespace App\Repository\Computer;

use App\Models\ComputerTypes;
use App\Repository\ComputerTypeRepositoryInterface;

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

    public function store(array $computerTypeData)
    {
        $computerType = $this->computerTypeModel->newInstance();
        $computerType->type = $computerTypeData['type'];
        return $computerType->save();
    }

    public function getSingle(int $computerTypeId)
    {
        return $this->computerTypeModel->find($computerTypeId);
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
}
