<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditEvenementRequest extends FormRequest
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
            "libelle" => "required",
            "description" => "required",
            "heure_evenement" => "required",
            "date_evenement" => "required|date",
            "lieu" => "required"

        ];
    }

        public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json([
            'success'=> false,
            'error'=> true,
            'message'=> 'erreur de validation',
            'errorLists' => $validator->errors(),
        ]));
    }

    public function messages()
    {
        return[
            "libelle.required" => "le libelle doit être fourni",
            "description" => "la description doit être fourni",
            "image.sometimes" => "l'image ne doit pas être null",
            "image.image" => "Seul les images sont autorisés",
            "date_evenement.required" => "La date est obligatoire",
            "date.date" => "Le format date n'est pas correct",
            "lieu.required" => "Le lieu est obligatoire"
        ];
    }
}
