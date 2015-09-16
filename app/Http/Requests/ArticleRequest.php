<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
    //laravel.com/docs/validation
    public function rules()
    {
        $rules = [
            //Title min value of 3 chars
            'title' => 'required|min:3',
            'body' => 'required',
//            'published_at' => 'required|date'
        //Published at required at and also date field
            'published_at' => ['required', 'date']
        ];

//        if($condition){
//            $rules['something_else'] = 'required;
//        }

        return $rules;
    }
}
