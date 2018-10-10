<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vacunas extends JsonResource
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
            'medicamento_id' => $this->medicamento_id,
            'created_at' => $this->created_at
        ];
    }
}
