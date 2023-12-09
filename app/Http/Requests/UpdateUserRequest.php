<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'nom' => 'required',
            'password' => 'sometimes|required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',
            'telephone' => 'required|regex:/^7[0-9]{8}$/',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorList' => $validator->errors(),
        ]));
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est requis',
            'password.required' => 'Le mot de passe est requis',
            'password.regex' => 'Le mot de passe doit contenir au moins 8 caractères avec un chiffre, une lettre et un caractère spécial',
            'telephone.required' => 'Le numéro de téléphone est requis',
            'telephone.regex' => 'Le format du numéro est incorrect',
        ];
    }
}
