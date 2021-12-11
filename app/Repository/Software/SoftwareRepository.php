<?php
declare(strict_types=1);

namespace App\Repository\Software;

use App\Models\Software;
use App\Repository\SoftwareRepositoryInterface;
use Illuminate\Support\Carbon;

class SoftwareRepository implements SoftwareRepositoryInterface
{
    private Software $softwareModel;

    public function __construct(Software $softwareModel)
    {
        $this->softwareModel = $softwareModel;
    }

    public function all()
    {
        return $this->softwareModel
                    ->with('worker')
                    ->paginate(25);
    }

    public function getSoftware(int $id)
    {
        return $this->softwareModel->find($id);
    }

    public function storeAndReturnId(array $softwareData)
    {
        $software = $this->softwareModel->newInstance();
        $software->producer = $softwareData['producer'];
        $software->serial_number = $softwareData['serial_number'];
        $software->name = $softwareData['name'];
        $software->worker_id = $softwareData['worker_id'];
        $software->description = $softwareData['description'];
        $software->date_of_buy = $softwareData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');
        $software->expiry_date = $softwareData['expiry_date'] ?? 'N/D';

        $software->save();

        return $software->id;
    }

    public function update(array $softwareData)
    {
        $software = $this->softwareModel->find($softwareData['id']);
        $software->producer = $softwareData['producer'];
        $software->serial_number = $softwareData['serial_number'];
        $software->name = $softwareData['name'];
        $software->worker_id = $softwareData['worker_id'];
        $software->description = $softwareData['description'];
        $software->date_of_buy = $softwareData['date_of_buy'] ?? Carbon::now()->format('Y-m-d');
        $software->expiry_date = $softwareData['expiry_date'] ?? 'N/D';

        return $software->save();
    }

    public function delete(int $id)
    {
        return $this->softwareModel->find($id)->delete();
    }

    public function countSoftwares()
    {
        return $this->softwareModel->all()->count();
    }
}
