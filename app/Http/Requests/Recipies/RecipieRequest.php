<?php

namespace App\Http\Requests\Recipies;

use Illuminate\Foundation\Http\FormRequest;

use Route;

class RecipieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        if($this->user()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $recipie = Route::input('recipie');
        return [
            'name' => 'required|max:255|unique:recipies,name'.($recipie ? ','.$recipie->id : ''),
            'notes' => '',
            'prep_time' => 'integer|nullable',
            'cook_time' => 'integer|nullable',
            'oven_temp' => 'integer|nullable',
            'origin' => 'string|nullable'
        ];
    }
}
