<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Problem;
use Route;

class CUProblemRequest extends FormRequest
{
    protected $rules;

    function __construct() {
        $this->rules = [
            "title" => 'required|string|max:128|unique:problems,title',
            "category" => "required|numeric|exists:categories,id",
            "abstraction" => "required|string|max:2048",
            "minorhint" => "required|string|max:256",
            "majorhint" => "required|string|max:1024",
            "flag" => "required|string|max:256",
            "problempageurl" => "nullable|url",
            "problemfilespath" => "nullable|url"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;      //Autherization is already done before reaching this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;

        if(Route::currentRouteName() == 'problem.update'){
            $problemId = $this->route('problem');  //bcz our route is put('problem/{problem}')
            $rules['category'] = 'nullable';
            $rules['title'] = 'required|string|max:128|unique:problems,title,' . $problemId . ',id';
        }

        return $rules;
    }
}
