<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dueños extends JsonResource
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
            'apellidos' => $this->apellidos,
            'edad' => $this->edad,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono
        ];
    }
}
