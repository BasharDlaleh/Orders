<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return $this->isMethod('post') ?
         [
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
         ] :
         [
            'customer_id' => 'exists:customers,id',
            'products' => 'array',
         ];
    }
}
