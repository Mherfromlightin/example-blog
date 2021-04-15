<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'categories' => 'nullable|array',
            'photo' => 'nullable|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:10000',
        ];
    }

    protected function prepareForValidation()
    {
        $this->offsetSet('categories', explode(',', $this->categories));
    }
}
