<?php
declare(strict_types=1);

namespace App\Repository\Peripheral;

use App\Models\Peripheral;
use App\Repository\PeripheralRepositoryInterface;
use Illuminate\Support\Carbon;

class PeripheralRepository implements PeripheralRepositoryInterface
{
    private Peripheral $peripheralModel;

    public function __construct(Peripheral $peripheralModel)
    {
        $this->peripheralModel = $peripheralModel;
    }

    public function all()
    {
        return $this->peripheralModel->get();
    }

    public function getPeripheral(int $id)
    {
        return $this->peripheralModel->find($id);
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
        $peripheral->date_of_buy = $peripheralData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');

        return $peripheral->save();
    }

    public function delete(int $id)
    {
        return $this->peripheralModel->find($id)->delete();
    }
}
