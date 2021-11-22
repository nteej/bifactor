<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
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
            'invoice_no' =>  [Rule::unique('invoices')->ignore($this->id),],
            'due_date' => 'required|date',
            'customer_id' => 'required',
            'company_id' => 'required',
            'total_amount' => 'required',
            'info' => 'array'
        ];
    }
}
