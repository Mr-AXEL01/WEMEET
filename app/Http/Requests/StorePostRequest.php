<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->user()->id,
            'body' => $this->input('body') ?: ''
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['nullable', 'string'],
            'attachments' => [
                'array',
                'max:50',
                ],
            'attachments.*' => [
                'file',
                File::types([
                    'jpj', 'jpeg', 'png', 'gif', 'webp',
                    'doc', 'docx', 'pdf', 'zip', 'mp3' ,
                    'wav', 'mp4', 'csv' , 'xls' , 'xlsx'
                ])->max(500 * 1024 * 1024),
            ],
            'user_id' =>['numeric','exists:users,id']
        ];
    }
}
