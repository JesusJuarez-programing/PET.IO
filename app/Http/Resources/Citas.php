<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Citas extends JsonResource
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
            'fecha_hora' => $this->fecha_hora,
            'tipo' => $this->tipo
        ];
    }
}
