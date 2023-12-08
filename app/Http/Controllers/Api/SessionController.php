<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\EditSessionRequest;
use App\Models\Session;
use Exception;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        try {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des sessions',
                    'session' => Session::all(),
                ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(CreateSessionRequest $request, Session $session)
    {
        try {
            $session->date_evenement = $request->date_evenement;
            $session->lieu = $request->lieu;
            $session->theme_evenement = $request->theme_evenement;
            $session->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vous avez ajouter une session',
                'session' => Session::all(),
            ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function update(EditSessionRequest $request, Session $session)
    {
        try {
            $session->date_evenement = $request->date_evenement;
            $session->lieu = $request->lieu;
            $session->theme_evenement = $request->theme_evenement;
            $session->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vous avez modifier cette session',
                'session' => Session::all(),
            ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Session $session)
    {
        try {
            $session->delete();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vous avez supprimer cette session',
                'session' => Session::all(),
            ]); 
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
