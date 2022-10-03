<?php
declare(strict_types=1);

namespace App\Repository\Worker;

use App\Models\Worker;
use App\Repository\WorkerRepositoryInterface;
use GuzzleHttp\Psr7\FnStream;
use Illuminate\Support\Facades\DB;

class WorkerRepository implements WorkerRepositoryInterface
{
    private Worker $workerModel;

    public function __construct(Worker $workerModel)
    {
        $this->workerModel = $workerModel;
    }

    public function all()
    {
        return $this->workerModel->with('department')->paginate(25);
    }
    public function allWithoutPaginate()
    {
        return $this->workerModel->all();
    }

    public function workerSearch(?string $filterName = null, ?string $filterDep = null)
    {
        if ($filterName && !$filterDep) {
            $result = $this->workerModel->where('name', 'LIKE', "%$filterName%")
                        ->orWhere('surname', 'LIKE', "%$filterName%")
                        ->with(['department' => function($q) {
                            $q->select(['id', 'name']);
                        }])
                        ->get(['id', 'name', 'phone', 'surname', 'department_id'])
                        ->toArray();
        } elseif ($filterDep && !$filterName) {
            $result = $this->workerModel->whereHas('department', function($q) use($filterDep) {
                            $q->where('name', 'LIKE', "%$filterDep%");
                        })
                        ->with('department', function ($q) {
                            $q->select(['id', 'name']);
                        })
                        ->get(['id', 'name', 'phone', 'surname', 'department_id'])
                        ->toArray();
        } elseif ($filterName && $filterDep) {
            $result = $this->workerModel->where(function($q) use($filterName){
                        $q->where('name', 'LIKE', "%$filterName%")
                        ->orWhere('surname', 'LIKE', "%$filterName%");
                    })
                    ->whereHas('department', function ($q) use ($filterDep) {
                        $q->where('name', 'LIKE', "%$filterDep%");
                    })
                    ->with('department', function ($q) {
                        $q->get(['id', 'name']);
                    })
                    ->get(['id', 'name', 'phone', 'surname', 'department_id'])
                    ->toArray();
        }

        return $result;
    }

    public function workersByDepartment(int $departmentId)
    {
        return $this->workerModel->query()->where('department_id', '=', $departmentId)->paginate(25);
    }

    public function getWorker(int $id)
    {
        return $this->workerModel->with('computers', 'softwares', 'peripherals')->find($id);
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

    public function countWorkers()
    {
        return $this->workerModel->all()->count();
    }
}
