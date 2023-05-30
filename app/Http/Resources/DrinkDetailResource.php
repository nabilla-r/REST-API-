<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class DrinkDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
       return [
           'id' => $this->id,
           'name_drink' => $this->name_drink,
           'flavor' => $this->flavor,
           'amount' => $this->amount,
           'type_drink' => $this->type_drink,
           'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
           'author' => $this->author,
           'write_orders' => $this->whenLoaded('write_orders')
       ];
    }
}
