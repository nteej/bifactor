<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request | Resource $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'invoice_no' => $this->invoice_no,
            'due_date' => $this->due_date,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'total_amount' => $this->total_amount,
            'info' => $this->info,
            'factoring' => $this->factoring,
            'state' => $this->state,
            'status' => $this->status,
        ];
    }
}
