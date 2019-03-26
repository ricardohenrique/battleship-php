<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestShot extends FormRequest
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
            'board_from' => ['required', 'integer'],
            'board_to'   => ['required', 'integer'],
            'position_x' => ['required', 'regex:/^[a-jA-J]+$/i'],
            'position_y' => ['required', 'regex:/^(?:[1-9]|0[1-9]|10)$/i'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'position_y.regex' => '[:attribute] - must be a number between 1 - 10',
            'position_x.regex' => '[:attribute] - must be a letter between a - j',
            'required' => '[:attribute] - is required',
            'integer' => '[:attribute] - must be integer',
        ];
    }
}
