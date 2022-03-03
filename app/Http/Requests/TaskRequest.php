<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'date' => 'required|date|date_format:Y-m-d',
            'project_name' => 'required',
            'task_module' => 'required',
            'estimated_hours' => 'required|integer',
            'worked_hours' => 'sometimes|required|integer',
            'task_status' => 'required' 
        ];
    }
}
