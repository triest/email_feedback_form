<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            //
                'email' => 'required|email|max:50',
                'name' => 'required|max:50',
                'person_data_processing_agree'=>'boolean',
                'text'=>'tex|max:1000',
        ];
    }
}
