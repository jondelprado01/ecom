<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestRules;

class CategoryRequestValidation extends FormRequest
{
    use RequestRules;
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
        return array_merge($this->categoryRules());
    }

    public function messages()
    {
        return array_merge($this->categoryRulesMessages());
    }
}
