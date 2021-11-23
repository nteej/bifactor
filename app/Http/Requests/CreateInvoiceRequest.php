<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_no' => 'required|unique:invoices,invoice_no',
            'due_date' => 'required|date',
            'customer_id' => 'required',
            'company_id' => 'required',
            'total_amount' => 'required',
            'factoring' => 'required',
            'info' => 'array'
        ];
    }
}
