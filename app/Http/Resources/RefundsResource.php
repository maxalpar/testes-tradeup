<?php

namespace App\Http\Resources;

use App\Domain\Entities\Refunds;
use Illuminate\Http\Resources\Json\JsonResource;

class RefundsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'identification' => $this->identification,
            'jobRole'        => $this->job_role,
            'refunds'        => RefundResource::collection($this->refunds),
            'createdAt'      => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
