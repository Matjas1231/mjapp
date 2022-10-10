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

    public function all()
    {
        return $this->workerModel->with('department')->paginate(25);
    }
    public function allWithoutPaginate()
    {
        return $this->workerModel->all();
    }

    //TODO stary sposób wyszukiwania
    public function filterBy(?array $filters)
    {
        if (!empty($filters)) {
            $workers = $this->workerModel->query();

            if (!empty($filters['filter'])) {
                $filter = $filters['filter'];
                $workers->where(DB::raw('("name" || " " || "surname")'), 'LIKE', "%$filter%")
                ->get();
            }

            if (!empty($filters['filterDeb'])) {
                $filterDeb = $filters['filterDeb'];
                $workers->whereHas('department', function($q) use($filterDeb) {
                    $q->where('name', 'LIKE', "%$filterDeb%");
                })->get();
            }

            return $workers->with('department')->paginate(25);
        } else {
            return $this->workerModel->with('department')->paginate(25);
        }
    }

    public function workerSearch(array $filters)
    {
        $workers = $this->workerModel->query();

        if (!is_null($filters['filterName'])) {
            $workers->where(DB::raw('("name" || " " || "surname")'), 'LIKE', "%{$filters['filterName']}%");
        }

        if (!is_null($filters['filterDep'])) {
            $workers->whereHas('department', function ($q) use($filters) {
                $q->where('name', 'LIKE', "{$filters['filterDep']}");
            });
        }

        $workers->with('department', function ($q) {
            $q->select(['id', 'name']);
        });

        return $workers->get(['id', 'name', 'phone', 'surname', 'department_id'])->toArray();
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
