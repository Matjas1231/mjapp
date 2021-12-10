<?php
declare(strict_types=1);

namespace App\Repository\Worker;

use App\Models\Worker;
use App\Repository\WorkerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class WorkerRepository implements WorkerRepositoryInterface
{
    private Worker $workerModel;

    public function __construct(Worker $workerModel)
    {
        $this->workerModel = $workerModel;
    }

    public function filterBy(?string $filterName)
    {
        if ($filterName != null) {
                $worker = DB::table('workers')
                                ->join('departments', 'workers.department_id', '=','departments.id')
                                ->select('departments.*')
                                ->select('workers.*')
                                ->orWhere('workers', 'LIKE', "%$filterName%")
                                ->orWhere('departments.name', 'LIKE', "%$filterName%")
                                ->get();
                                dd($worker);
            // $query = $this->workerModel->orWhere('name', 'LIKE', "%$filterName%")
            //                             ->orWhere('surname', 'LIKE', "%$filterName%")
            //                             ->with('department')
            //                             ->orWhere('name', 'LIKE', "%$filterName%")
            //                             ->get();
            return $worker;
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
