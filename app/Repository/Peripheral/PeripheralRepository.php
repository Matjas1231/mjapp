<?php
declare(strict_types=1);

namespace App\Repository\Peripheral;

use App\Models\Peripheral;
use App\Repository\PeripheralRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PeripheralRepository implements PeripheralRepositoryInterface
{
    private Peripheral $peripheralModel;

    public function __construct(Peripheral $peripheralModel)
    {
        $this->peripheralModel = $peripheralModel;
    }

    // Stary sposób wyszukiwania
    public function filterBy(?array $filters)
    {
        if (!empty($filters)) {
            $peripherals = $this->peripheralModel->query();

            if (!empty($filters['filter'])) {
                $fullname = $filters['filter'];
                $peripherals->whereHas('worker', function($q) use($fullname) {
                    $q->where(DB::raw('("name" || "surname")'), 'LIKE', "%$fullname%");
                })->get();
            }

            if (!empty($filters['peripheraltype'])) {
                $peripheralType = $filters['peripheraltype'];
                $peripherals->whereHas('peripheralType', function($q) use($peripheralType) {
                    $q->where('type', 'LIKE', "%$peripheralType%");
                })->get();
            }

            if (!empty($filters['brand'])) {
                $producer = $filters['brand'];
                $peripherals->where('brand', 'LIKE', "%$producer%")->get();
            }

            if (!empty($filters['model'])) {
                $model = $filters['model'];
                $peripherals->where('model', 'LIKE', "%$model%")->get();
            }

            if (!empty($filters['serialnumber'])) {
                $serialnumber = $filters['serialnumber'];
                $peripherals->where('serial_number', 'LIKE', "%$serialnumber%")->get();
            }

            if (!empty($filters['ipaddress'])) {
                $ipaddress = $filters['ipaddress'];
                $peripherals->where('ip_address', 'LIKE', "%$ipaddress%")->get();
            }

            if (!empty($filters['macaddress'])) {
                $macaddress = $filters['macaddress'];
                $peripherals->where('mac_address', 'LIKE', "%$macaddress%")->get();
            }

            if (!empty($filters['networkname'])) {
                $networkName = $filters['networkname'];
                $peripherals->where('network_name', 'LIKE', "%$networkName%")->get();
            }

            return $peripherals->with(['worker', 'peripheralType'])->paginate(25);
        } else {
            return $this->peripheralModel->with(['worker', 'peripheralType'])->paginate(25);
        }
    }

    public function all()
    {
        return $this->peripheralModel->with(['worker', 'peripheralType'])->paginate(25);
    }

    public function searchPeripheral($filters)
    {
        $peripheral = $this->peripheralModel->query();

        if (!is_null($filters['filterName'])) {
            $peripheral->whereHas('worker', function ($q) use($filters) {
                $q->where(DB::raw('("name" || " " || "surname")'), 'LIKE', "%{$filters['filterName']}%");
            });
        }

        if (!is_null($filters['filterType'])) {
            $peripheral->whereHas('peripheralType', function ($q) use($filters) {
                $q->where('type', 'LIKE', "%{$filters['filterType']}%");
            });
        }

        if (!is_null($filters['filterBrand'])) $peripheral->where('brand', 'LIKE', "%{$filters['filterBrand']}%");
        if (!is_null($filters['filterModel'])) $peripheral->where('model', 'LIKE', "%{$filters['filterModel']}%");
        if (!is_null($filters['filterSerialNumber'])) $peripheral->where('serial_number', 'LIKE', "%{$filters['filterSerialNumber']}%");
        if (!is_null($filters['filterIpAddress'])) $peripheral->where('ip_address', 'LIKE', "%{$filters['filterIpAddress']}%");
        if (!is_null($filters['filterMacAddress'])) $peripheral->where('mac_address', 'LIKE', "%{$filters['filterMacAddress']}%");
        if (!is_null($filters['filterNetworkName'])) $peripheral->where('network_name', 'LIKE', "%{$filters['filterNetworkName']}%");

        $peripheral->with('worker', fn($q) => $q->select(['id', 'name', 'surname']))
        ->with('peripheralType', fn($q) => $q->select(['id', 'type']));

        return $peripheral->get([
            'id', 'worker_id', 'type_id', 'brand', 'model', 'ip_address', 'mac_address', 'network_name', 'serial_number'
            ])->toArray();
    }

    public function peripheralWithoutWorker()
    {
        return $this->peripheralModel->where('worker_id', '=', null)->get(['id', 'worker_id', 'type_id', 'brand', 'model', 'ip_address', 'mac_address', 'network_name', 'serial_number'])->toArray();
    }

    public function peripheralsByType(int $typeId)
    {
        return $this->peripheralModel->query()->where('type_id', '=', $typeId)->with('worker')->paginate(25);
    }

    public function getPeripheral(int $id)
    {
        return $this->peripheralModel->with(['worker', 'peripheralType'])->find($id);
    }

    public function storeAndReturnId(array $peripheralData)
    {
        $peripheral = $this->peripheralModel->newInstance();

        $peripheral->brand = $peripheralData['brand'];
        $peripheral->model = $peripheralData['model'];
        $peripheral->serial_number = $peripheralData['serial_number'] ?? 'N/D';
        $peripheral->type_id = $peripheralData['type_id'];
        $peripheral->description = $peripheralData['description'];
        $peripheral->worker_id = $peripheralData['worker_id'];
        $peripheral->ip_address = $peripheralData['ip_address'] ?? 'N/D';
        $peripheral->mac_address = $peripheralData['mac_address'] ?? 'N/D';
        $peripheral->network_name = $peripheralData['network_name'] ?? 'N/D';
        $peripheral->date_of_buy = $peripheralData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');

        $peripheral->save();

        return $peripheral->id;
    }

    public function update(array $peripheralData)
    {
        $peripheral = $this->peripheralModel->find($peripheralData['id']);
        $peripheral->brand = $peripheralData['brand'];
        $peripheral->model = $peripheralData['model'];
        $peripheral->serial_number = $peripheralData['serial_number'] ?? 'N/D';
        $peripheral->type_id = $peripheralData['type_id'];
        $peripheral->description = $peripheralData['description'];
        $peripheral->worker_id = $peripheralData['worker_id'];
        $peripheral->ip_address = $peripheralData['ip_address'] ?? 'N/D';
        $peripheral->mac_address = $peripheralData['mac_address'] ?? 'N/D';
        $peripheral->network_name = $peripheralData['network_name'] ?? 'N/D';
        $peripheral->date_of_buy = $peripheralData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');

        return $peripheral->save();
    }

    public function delete(int $id)
    {
        return $this->peripheralModel->find($id)->delete();
    }
}
