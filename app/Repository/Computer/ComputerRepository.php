<?php
declare(strict_types=1);

namespace App\Repository\Computer;

use App\Models\Computer;
use App\Repository\ComputerRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComputerRepository implements ComputerRepositoryInterface
{
    private Computer $computerModel;

    public function __construct(Computer $computerModel)
    {
        $this->computerModel = $computerModel;
    }

    public function filterBy(?array $filters)
    {
        if (!empty($filters)) {
            $computers = $this->computerModel->query();

            if (!empty($filters['filter'])) {
                $fullname = $filters['filter'];
                $computers->whereHas('worker', function($q) use($fullname) {
                    $q->where(DB::raw('("name" || "surname")'), 'LIKE', "%$fullname%");
                })->get();
            }

            if (!empty($filters['computertype'])) {
                $computertype = $filters['computertype'];
                $computers->whereHas('computerType', function($q) use($computertype) {
                    $q->where('type', 'LIKE', "%$computertype%");
                })->get();
            }

            if (!empty($filters['brand'])) {
                $producer = $filters['brand'];
                $computers->where('brand', 'LIKE', "%$producer%")->get();
            }

            if (!empty($filters['model'])) {
                $model = $filters['model'];
                $computers->where('model', 'LIKE', "%$model%")->get();
            }

            if (!empty($filters['serialnumber'])) {
                $serialnumber = $filters['serialnumber'];
                $computers->where('serial_number', 'LIKE', "%$serialnumber%")->get();
            }

            if (!empty($filters['ipaddress'])) {
                $ipaddress = $filters['ipaddress'];
                $computers->where('ip_address', 'LIKE', "%$ipaddress%")->get();
            }

            if (!empty($filters['macaddress'])) {
                $macaddress = $filters['macaddress'];
                $computers->where('mac_address', 'LIKE', "%$macaddress%")->get();
            }

            if (!empty($filters['computername'])) {
                $computername = $filters['computername'];
                $computers->where('network_name', 'LIKE', "%$computername%")->get();
            }

            return $computers->with('worker' ,'computerType')->paginate(25);
        } else {
            return $this->computerModel->with(['worker', 'computerType'])->paginate(25);
        }
    }

    public function searchComputer(array $filters)
    {
        $computer = $this->computerModel->query();

        if (!is_null($filters['filterName'])) {
            $computer->whereHas('worker', function ($q) use($filters) {
                $q->where(DB::raw('("name" || " " || "surname")'), 'LIKE', "%{$filters['filterName']}%");
            });
        }

        if (!is_null($filters['filterType'])) {
            $computer->whereHas('computerType', function ($q) use($filters) {
                $q->where('type', 'LIKE', "%{$filters['filterType']}%");
            });
        }

        if (!is_null($filters['filterBrand'])) $computer->where('brand', 'LIKE', "%{$filters['filterBrand']}%");
        if (!is_null($filters['filterModel'])) $computer->where('model', 'LIKE', "%{$filters['filterModel']}%");
        if (!is_null($filters['filterSerialNumber'])) $computer->where('serial_number', 'LIKE', "%{$filters['filterSerialNumber']}%");
        if (!is_null($filters['filterIpAddress'])) $computer->where('ip_address', 'LIKE', "%{$filters['filterIpAddress']}%");
        if (!is_null($filters['filterMacAddress'])) $computer->where('mac_address', 'LIKE', "%{$filters['filterMacAddress']}%");
        if (!is_null($filters['filterNetworkName'])) $computer->where('network_name', 'LIKE', "%{$filters['filterNetworkName']}%");

        $computer->with('worker', fn($q) => $q->select(['id', 'name', 'surname']))
            ->with('computerType', fn($q) => $q->select(['id', 'type']));

        return $computer->get([
            'id', 'worker_id', 'type_id', 'brand', 'model', 'ip_address', 'mac_address', 'network_name', 'serial_number'
            ])->toArray();
    }

    public function computerWithoutWorker()
    {
        return $this->computerModel->where('worker_id', '=', null)->get(['id', 'worker_id', 'type_id', 'brand', 'model', 'ip_address', 'mac_address', 'network_name', 'serial_number'])->toArray();
    }

    public function all()
    {
        return $this->computerModel
                    ->with(['worker', 'computerType'])
                    ->paginate(25);
    }

    public function getComputer(int $id)
    {
        return $this->computerModel->find($id);
    }

    public function computersByType(int $typeId)
    {
        return $this->computerModel->query()->where('type_id', '=', $typeId)->with('worker')->paginate(25);
    }

    public function storeAndReturnId(array $computerData)
    {
        $computer = $this->computerModel->newInstance();
        $computer->brand = $computerData['brand'];
        $computer->model = $computerData['model'];
        $computer->type_id = $computerData['type_id'];
        $computer->processor = $computerData['processor'];
        $computer->motherboard = $computerData['motherboard'];
        $computer->ram = $computerData['ram'];
        $computer->description = $computerData['description'];
        $computer->worker_id = $computerData['worker_id'];
        $computer->ip_address = $computerData['ip_address'] ?? 'Dynamic';
        $computer->mac_address = $computerData['mac_address'] ?? '00:00:00:00:00:00';
        $computer->network_name = $computerData['network_name'];
        $computer->serial_number = $computerData['serial_number'];
        $computer->date_of_buy = $computerData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');
        $computer->save();

        return $computer->id;
    }

    public function update(array $computerData)
    {
        $computer = $this->computerModel->find($computerData['id']);
        $computer->brand = $computerData['brand'];
        $computer->model = $computerData['model'];
        $computer->type_id = $computerData['type_id'];
        $computer->processor = $computerData['processor'];
        $computer->motherboard = $computerData['motherboard'];
        $computer->ram = $computerData['ram'];
        $computer->description = $computerData['description'];
        $computer->worker_id = $computerData['worker_id'];
        $computer->ip_address = $computerData['ip_address'] ?? 'Dynamic';
        $computer->mac_address = $computerData['mac_address'] ?? '00:00:00:00:00:00';
        $computer->network_name = $computerData['network_name'];
        $computer->serial_number = $computerData['serial_number'];
        $computer->date_of_buy = $computerData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');
        return $computer->save();
    }

    public function delete(int $id)
    {
        return $this->computerModel->find($id)->delete();
    }

    public function countComputers()
    {
        return $this->computerModel->all()->count();
    }
}
