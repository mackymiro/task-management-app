<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:tasks',
            'content' => 'required|string',
            'status' => 'required|in:to-do,in-progress,done',
            'uploadImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096' //image, max size 4MB (4096KB)
        ];
    }
}
