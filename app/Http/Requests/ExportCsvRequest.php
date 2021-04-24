<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportCsvRequest extends FormRequest
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
            'headers' => ['required', 'array', 'min:1'],
            'rows' => ['required', 'array', 'min:1']
        ];
    }
}
