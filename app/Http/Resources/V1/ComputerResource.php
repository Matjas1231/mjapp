<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ComputerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'type' => $this->computerType->type,
            'processor' => $this->processor,
            'motherboard' => $this->motherboard,
            'ram' => $this->ram,
            'description' => $this->description,
            'ipAddress' => $this->ip_address,
            'networkName' => $this->network_name,
            'macAddress' => $this->mac_address,
            'serialNumber' => $this->serial_number,
            'dateOfBuy' => $this->date_of_buy,
            'worker' => new WorkerResource($this->worker)
        ];
    }
}
