<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSessionRequest extends FormRequest
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
            "mentors_id" => "required",
            "users_id" => "required",
            "en_ligne" =>"required",
            "theme" => "required",
            "libelle" => "required",
        ];
    }

    public function failedValidation(Validator $validator ){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=>$validator->errors()
        ]));
    }

    public function messages()
    {
        return[
            "mentors_id.required" => "Id mentor est obligatoire",
            "users_id.required" => "L'utilisateur est obligatoire",
            "theme.required" => "Le theme ne peut pas être null",
            "en_ligne.required" => "le champ en ligne ne peut pas être null",
            "libelle.required" => "Le libelle ne peut pas être null"
        ];
    }
}
