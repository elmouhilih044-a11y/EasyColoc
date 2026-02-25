<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
           'name' => 'required|string|max:255',
        'colocation_id' => 'required|exists:colocations,id',
        ];
    }

public function messages()
{
   return[
    'name.required'=>'Le nom de la catégorie est obligatoire !',
    'name.string'=>'Le nom de la catégorie doit être une chaine de caractères !',
    'name.max'=>'Le nom de la catégorie est trop long !',
    'colocation_id.required' => 'La colocation est obligatoire !',
    'colocation_id.exists' => 'La colocation sélectionnée n\'existe pas !',
   ]; 
}
}
