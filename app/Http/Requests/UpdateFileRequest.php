<?php

namespace Plans\Http\Requests;

use Plans\Http\Requests\Request;

class UpdateFileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('add_file');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'required',
            'floor_id' => 'required',
            'name' => 'required',
        ];
    }
}
