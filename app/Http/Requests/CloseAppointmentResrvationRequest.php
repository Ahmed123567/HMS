<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CloseAppointmentResrvationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "diagnosis" => ["required"],
            "description" => ["required"],
            "files" => [""],
            "files.*" => 'mimes:jpg,jpeg,png,bmp,pdf|max:20000',
        ];
    }

    public function storeFiles()
    {
        $filePathes = [];

        if($this->has("files")) {
            foreach ($this->file('files') as $file) {
                $path = $file->store('public/files/');
                $filePathes[] = $path;
            }
        }
        
        return $filePathes;
    }

    public function data() {
        $validated = $this->validated();
        $validated["files"] = $this->storeFiles();
        return $validated;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        throw ValidationException::withMessages([
            "error" => $validator->getMessageBag()->first()
        ]);
    }
}
