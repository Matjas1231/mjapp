<?php
declare(strict_types=1);

namespace App\Repository\Worker;

use App\Models\Department;
use App\Models\Worker;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class WorkerRepository implements WorkerRepositoryInterface
{
    private Worker $workerModel;

    public function __construct(Worker $workerModel)
    {
        $this->workerModel = $workerModel;
    }

    public function filterBy(?string $phraseName)
    {
        if ($phraseName!= null) {
            // $phraseName = $phrases['phraseName'];
            $query = $this->workerModel->where('name', 'LIKE', "%$phraseName%")
                                        ->orWhere('surname', 'LIKE', "%$phraseName%")
                                        ->get();
            return $query;
        } else {
            return $this->workerModel->all();
        }
    }


    public function all()
    {
        return $this->workerModel->all();
    }

    public function getWorker(int $id)
    {
        return $this->workerModel->find($id);
    }

    public function storeAndReturnId(array $workerData)
    {
        $worker = $this->workerModel->newInstance();
        $worker->name = $workerData['name'];
        $worker->surname = $workerData['surname'];
        $worker->position = $workerData['position'];
        $worker->department_id = $workerData['department_id'];
        $worker->phone = $workerData['phone'];
        $worker->save();

        return $worker->id;
    }

    public function update(array $workerData)
    {
        $worker = $this->workerModel->find($workerData['id']);
        $worker['name'] = $workerData['name'];
        $worker['surname'] = $workerData['surname'];
        $worker['position'] = $workerData['position'];
        $worker['department_id'] = $workerData['department_id'];
        $worker['phone'] = $workerData['phone'];

        return $worker->save();
    }

    public function delete(int $id)
    {
        $worker = $this->workerModel->find($id);
        return $worker->delete();
    }
}
