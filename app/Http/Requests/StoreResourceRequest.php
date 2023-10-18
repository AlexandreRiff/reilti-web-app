<?php

namespace App\Http\Requests;

use App\Models\Media;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Factories\ResourceFile\ResourceFileFactory;

class StoreResourceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'techArea' => ['nullable', 'string', 'min:3', 'max:255'],
            'course' => ['nullable', 'string', 'min:3', 'max:255'],
            'discipline' =>  ['nullable', 'string', 'min:3', 'max:255'],
            'language' => Rule::in(Language::pluck('id')),
            'description' => ['nullable', 'string', 'min:3'],
            'media' => ['required', 'string', Rule::in(Media::pluck('id'))],
            'file' => ['required', 'file', 'max:50000'],
            'tags' => ['nullable', 'string', 'min:3', 'max:255'],
            'image' => ['nullable', 'image', 'max:50000'],
            'visibility' => Rule::in(['public', 'private']),
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(Validator $validator, ResourceFileFactory $resourceFileFactory): array
    {
        $media = $validator->safe()->media;

        $mediaType = Media::find($media)->type;

        $resourceFile = $resourceFileFactory->make($mediaType);

        return [
            ...$resourceFile->validate($validator),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'file.max' => 'O campo :attribute não pode ser superior a 50MB.',
            'image.max' => 'O campo :attribute não pode ser superior a 50MB.',
        ];
    }
}
