<?php
declare(strict_types=1);

namespace App\Repository\Software;

use App\Models\Software;
use App\Repository\SoftwareRepositoryInterface;

class SoftwareRepository implements SoftwareRepositoryInterface
{
    private Software $softwareModel;

    public function __construct(Software $softwareModel)
    {
        $this->softwareModel = $softwareModel;
    }

    public function all()
    {
        return $this->softwareModel->get();
    }

    public function getSoftware(int $id)
    {
        return $this->softwareModel->find($id);
    }

    public function storeAndReturnId(array $peripheralData)
    {

    }

    public function update(array $peripheralData)
    {

    }

    public function delete(int $id)
    {

    }
}
