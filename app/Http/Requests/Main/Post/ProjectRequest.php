<?php

namespace App\Http\Requests\Main\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => 'required|max:100',
            'description' => 'required',
            'category'    => 'required|exists:projects_categories,id',
            'skills'      => 'required|array|min:1|max:5',
            'skills.*'    => [ Rule::exists('projects_skills', 'id')->where(function($query) {
                return $query->where('category_id', $this->request->get('category'));
            }) ],
            'salary_type' => 'required|in:hourly,fixed,per_word,per_minute,per_unit,per_chapter,per_book,per_course,per_video,per_animation,per_art_image,per_cover,per_page,per_question,per_others',
            'price_min'   => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/'],
            'price_max'   => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/']
        ];
    }


    /**
     * Set validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('messages.t_validator_required'),
        ];
    }
}
