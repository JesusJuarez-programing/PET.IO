<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Operaciones extends JsonResource
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
            'tipo' => $this->tipo,
            'sala' => $this->sala,
            'fecha_hora' => $this->fecha_hora
        ];
    }
}
