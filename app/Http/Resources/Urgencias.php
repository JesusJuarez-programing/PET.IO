<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Urgencias extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'mascota_id' => $this->mascota_id,
            'doctor_id' => $this->doctor_id,
            'created_at' => $this->created_at,
        ];
    }
}
