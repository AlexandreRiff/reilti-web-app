<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Factories\ResourceFile\ResourceFileFactory;

class UpdateResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->resource);
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
            'file' => ['nullable', 'file'],
            'tags' => ['nullable', 'string', 'min:3', 'max:255'],
            'image' => ['nullable', 'image'],
            'visibility' => Rule::in(['public', 'private']),
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(Validator $validator, ResourceFileFactory $resourceFileFactory): array
    {
        $mediaType = $this->resource->media->type;

        $resourceFile = $resourceFileFactory->make($mediaType);

        return [
            ...$resourceFile->validate($validator),
        ];
    }
}
