<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
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

        public function updateUser(UpdateUserRequest $request, User $user)
        {
            try {
    
                $user->nom = $request->nom ?? $user->nom;
                if($user->telephone!==$user->telephone){
                $user->telephone = $request->telephone ?? $user->telephone;}
                $user->statut = $request->statut ?? $user->statut;

                if ($request->has('new_password') && Hash::check($request->old_password, $user->password)) {
                    // Le mot de passe fourni correspond à celui dans la base de données
                    $user->password = Hash::make($request->new_password);
                }
    
                $user->update();
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Informations utilisateur mises à jour avec succès',
                    'status_body' => $user
                ]);
    
            } catch (Exception $e) {
                return response()->json([$e]);
            }
        }
    
        public function showUser(User $user)
        {
            try {
    
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Détails de l\'utilisateur récupérés avec succès',
                    'status_body' => $user
                ]);
    
            } catch (Exception $e) {
                return response()->json([$e]);
            }
        }

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

        public function filterUsersByName(Request $request)
        {
            try {
                $nameFilter = $request->input('search');
        
                 $users = User::where('nom', 'like', '%' . $nameFilter . '%')->get();
                

        
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Utilisateurs filtrés par nom avec succès',
                    'filtered_users' => $users,
                ]);
        
            } catch (Exception $e) {
                return response()->json([$e]);
            }
        }

        public function index()
        {
            try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste de tous les mentorés',
                    'Mentor' => User::all(),
                ]); 
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

        public function mentoreNonArchive()
        {
            try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste de tous les mentorés non archivés',
                    'Mentor' => User::where('is_archived',0)->get(),
                ]); 
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

        public function mentoreArchive()
        {
            try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste de tous les mentorés archivés',
                    'Mentor' => User::where('is_archived',1)->get(),
                ]); 
            } catch (Exception $e) {
                return response()->json($e);
            }
        }
        
        public function archive (User $user)
        {
            try {
                $user->update([
                    'is_archived'=> 1
                ]);
                return response()->json([
                    'status_code' => 200,
                    'status_message' => "Vous avez archivés ce mentor"
                ]); 
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

        public function verifMailUser(Request $request){
            $user=User::where('email',$request->email)->first();
            if($user){
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Utilisateur trouvé',
                    'user' => $user,
                ]);
            }
            else{
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Utilisateur non inscrit'
                ]);
            }
    
        }

        public function resetPasswordUser(Request $request,User $user){
            $request->validate([
                'password'=>'required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/'
            ]);
            $user->password=$request->password;
            $user->save();
           //dd($user);
            if($user){
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Votre mot de passe a été modifier',
                    'user' => $user,
                ]);
            }else{
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Votre mot de passe est invalide',
                    'user' => $user,
                ]);
            }
    
        }

    }