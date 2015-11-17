<?php namespace Plans\Http\Requests;

use Plans\Http\Requests\Request;

class UserRequest extends Request {

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

        $input = Request::all();

        if($input['update']) {
            if($input['password']) {
                return [
                    'email' => 'required|email|unique:users,email,'.$this->getSegmentFromEnd(),
                    'first_name' => 'required|min:3',
                    'last_name' => 'required|min:3',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ];
            } else {
                return [
                    'email' => 'required|email|unique:users,email,'.$this->getSegmentFromEnd(),
                    'first_name' => 'required|min:3',
                    'last_name' => 'required|min:3',
                ];
            }
        }

		return [
            'email' => 'required|email|unique:users,email,'.$this->getSegmentFromEnd(),
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
		];
	}


    private function getSegmentFromEnd($position_from_end = 1) {
        $segments =$this->segments();
        return $segments[sizeof($segments) - $position_from_end];
    }

}
