<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return (bool) $this->user();
    }
    public function rules()
    {
        return [
            'invoice_id' => "required|exists:invoices,id",
            'amount' => "required",

        ];
    }
}
