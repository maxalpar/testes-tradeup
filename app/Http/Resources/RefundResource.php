<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RefundResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date'        => $this->date,
            'type'        => $this->type,
            'description' => $this->description,
            'value'       => $this->value
        ];
    }
}
