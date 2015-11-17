<?php

namespace Plans\Http\Requests;

use Plans\Http\Requests\Request;

class CreatePermissionRequest extends Request
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
            'name' => 'required|min:3|unique:roles,name,' .$this->getSegmentFromEnd(). ',id',
            'label' => 'required|min:3|unique:roles,label,' .$this->getSegmentFromEnd(). ',id',
        ];
    }

    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }
}
