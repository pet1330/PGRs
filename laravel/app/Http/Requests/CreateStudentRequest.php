<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateStudentRequest extends Request
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
            'award_id' => 'required',
            'award_type_id' => 'required',
            'email' => 'required|email|unique:users',
            'enrolment' => 'required|unique:students',
            'enrolment_status_id' => 'required',
            'first_name' => 'required|string',
            'funding_type_id' => 'required',
            'home_address' => 'required',
            'last_name' => 'required|string',
            'locked' => 'boolean',
            'middle_name' => 'string',
            'nationality' => 'required|string',
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'start' => 'required|date',
            'title' => 'string',
            'ukba_status_id' => 'required',
        ];
    }
}
