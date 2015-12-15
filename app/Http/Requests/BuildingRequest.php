<?php

namespace Plans\Http\Requests;

use Plans\Http\Requests\Request;

class BuildingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('create_building');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'building_name' => 'required',
            'street' => 'required',
            'town' => 'required',
            'postal' => 'required',
            'province' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'description' => 'required',
            'building_type' => 'required',
        ];
    }
}
