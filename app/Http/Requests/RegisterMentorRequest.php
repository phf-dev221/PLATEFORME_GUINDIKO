<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterMentorRequest extends FormRequest
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
            'nom'=>'required',
            'email'=>'required|unique:mentors,email|email',
            'photo_profil'=>'required|image|max:2000|mimes:jpeg,png,jpg',
            'password'=>'required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',
            'telephone' =>'required|regex:/^7[0-9]{8}$/|unique:mentors,telephone',
            'specialite'=>'required',
            'nombre_annee_experience'=>'required'
        ];
    }

    public function failedValidation(validator $validator ){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=>$validator->errors()
        ]));
    }

    public function messages(){
        return [
            'nom.required'=>'le nom est requis',
            'email.required'=>'l\'email est requis',
            'email.unique'=>'l\'email existe deja dans notre base de données',
            'email.email'=>'Format email incorrect',
            'photo_profil.required'=>'Entrez une photo de profil',
            'password.required'=>'le mot de passe est requis',
            'password.regex'=>"le mot de passe doit contenir au moins 8 caractéres avec un chiffre, une lettre et un caractére spécial",
            'specialite.required'=>'la spécialité est requis',
            'telephone.required'=>'le telephone est requis',
            'telephone.unique'=>'le numéro telephone est deja utilisé',
            'telephone.regex'=>'le format du numéro de téléphone est incorrect',
            'nombre_annee_experience.required'=>'le nombre d\'année d\'expérience est requis est requis',

        ];
    }

}

