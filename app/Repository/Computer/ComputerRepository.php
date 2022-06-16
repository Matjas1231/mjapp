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
                $computers->where('computer_name', 'LIKE', "%$computername%")->get();
            }

            return $computers->with('worker' ,'computerType')->paginate(25);
        } else {
            return $this->computerModel->with(['worker', 'computerType'])->paginate(25);
        }
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
        $computer->computer_name = $computerData['computer_name'];
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
        $computer->computer_name = $computerData['computer_name'];
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
