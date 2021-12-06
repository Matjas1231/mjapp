<?php
declare(strict_types=1);

namespace App\Repository\Computer;

use App\Models\Computer;
use App\Repository\ComputerRepositoryInterface;
use Illuminate\Support\Carbon;

class ComputerRepository implements ComputerRepositoryInterface
{
    private Computer $computerModel;

    public function __construct(Computer $computerModel)
    {
        $this->computerModel = $computerModel;
    }

    public function all()
    {
        return $this->computerModel->get();
    }

    public function getComputer(int $id)
    {
        return $this->computerModel->find($id);
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
        $computer->computer_name = $computerData['computer_name'];
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
        $computer->computer_name = $computerData['computer_name'];
        $computer->date_of_buy = $computerData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');
        return $computer->save();
    }

    public function delete(int $id)
    {
        return $this->computerModel->find($id)->delete();
    }
}
