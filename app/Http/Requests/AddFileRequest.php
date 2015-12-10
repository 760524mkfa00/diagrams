<?php

namespace Plans\Http\Requests;

use Plans\Http\Requests\Request;

class AddFileRequest extends Request
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
            'file_name' => 'required',
            'floor' => 'required',
            'file' => 'required|mimes:pdf',
        ];
    }
}
