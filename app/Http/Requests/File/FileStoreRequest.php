<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class FileStoreRequest extends FormRequest
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
            'files' => 'array',
            'files.*' => 'file|required',
            'type' => 'required|in:image,file'
        ];
    }

    public function store(): array
    {
        $result = [];

        foreach ($this->file('files') as $file) {
            $result[] = Storage::put('files', $file);
        }

        return $result;
    }
}
