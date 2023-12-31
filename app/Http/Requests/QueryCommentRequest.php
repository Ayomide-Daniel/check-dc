<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueryCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['integer', 'nullable'],
            'user_id' => ['integer', 'nullable'],
            'hacker_news_id' => ['integer', 'nullable'],
            'story_id' => ['integer', 'nullable'],
            'parent_id' => ['integer', 'nullable'],
        ];
    }
}
