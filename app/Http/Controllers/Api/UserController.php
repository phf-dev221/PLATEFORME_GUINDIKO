<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;


class UserController extends Controller
{

    

    public function register(RegisterUserRequest $request)
    {
        try{
            $user = new User(); 
    
            $user->nom = $request->nom;
            $user->telephone = $request->telephone;
            $user->statut = $request->statut;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            
            $user->save();
            return response()->json([
                'status_code'=>200,
                'status_message'=>'utilisateur ajouté avec succes',
                'status_body'=>$user
            ]);
    
            }
            catch(Exception $e){
                return response()->json([$e]);
            }
    
        }

        // public function login(LoginMentoreRequest $request){

        //     if(auth()->attempt($request->only(['email','password']))){
        //         $user = auth()->user();
        //         $token = $user->createToken('cle_secret_pour_le_back')->plainTextToken;
    
        //         return response()->json([
        //             'status_code'=>200,
        //             'status_message'=>'utilisateur connecté',
        //             'status_body'=>$user,
        //             'token'=>$token
        //         ]);
        //     }
        //     else{
                
        //         return response()->json([
        //             'status_code'=>403,
        //             'status_message'=>'Identifiants non valides',
    
        //         ]);
        //     }
        // }

        public function logoutUser(){
            if(auth()->check()){
                Auth::user()->tokens()->delete();
                Auth::logout();
                
                return response()->json([
                    "status_code"=>200,
                    "status_message"=>"deconnexion reussie"
                ]);
            }
        }


    }