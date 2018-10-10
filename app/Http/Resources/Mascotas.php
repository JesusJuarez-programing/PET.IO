<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Mascotas extends JsonResource
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
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'dueño_id' => $this->dueño_id,
            'raza' => $this->raza
        ];
    }
}
