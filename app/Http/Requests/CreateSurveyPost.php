<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSurveyPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->input('user_id') == $this->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'survey.name' => 'required|max:191|unique:surveys,name,NULL,id,user_id,'.$this->input('user_id'),
            'survey.description' => 'max:191'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The user id is required.',
            'survey.name.required' => 'The survey name is required.',
            'survey.name.unique' => 'The survey name must be unique.',
            'survey.description.max' => 'The survey description must be :max characters or less'
        ];
    }
}
