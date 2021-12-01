<?php
declare(strict_types=1);

namespace App\Repository\Worker;

use App\Models\Worker;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Support\Carbon;

class WorkerRepository implements WorkerRepositoryInterface
{
    private Worker $workerModel;

    public function __construct(Worker $workerModel)
    {
        $this->workerModel = $workerModel;
    }

    public function all()
    {
        return $this->workerModel->get();
    }

    public function get(int $id)
    {
        return $this->workerModel->find($id);
    }

    public function save(array $workerData)
    {
        $worker = $this->workerModel->newInstance();
        $worker->name = $workerData['name'];
        $worker->surname = $workerData['surname'];
        $worker->position = $workerData['position'];
        $worker->department_id = $workerData['department_id'];
        $worker->phone = $workerData['phone'];

        return $worker->save();
    }

    public function update(array $workerData)
    {
        $worker = $this->workerModel->find($workerData['id']);
        $worker['name'] = $workerData['name'];
        $worker['surname'] = $workerData['surname'];
        $worker['position'] = $workerData['position'];
        $worker['department_id'] = $workerData['department_id'];
        $worker['phone'] = $workerData['phone'];
        $worker['updated_at'] = Carbon::now();

        // return $worker->fill($workerData)->save();
        return $worker->save();
    }
}
