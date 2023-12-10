<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\EditSessionRequest;
use App\Models\Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index(Session $session)
    {
        try {
            if ($session->est_archive == 0) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des sessions non archivés',
                    'session' => Session::where('est_archive', 0)->get(),
                ]); 
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function archive(Session $session)
    {
        try {
            $session->update([
                "est_archive"=>1,
            ]);
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Vous avez archivés cette sessions',
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function sessionArchive(Session $session)
    {
        try {
            if ($session->est_archive == 1) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des sessions archivés',
                    'session' => Session::where('est_archive', 1)->get(),
                ]); 
            }
    } catch (Exception $e) {
        return response()->json($e);
    }
    }

    public function store(Request $request)
    {

        $session = new Session();

        try {
            // dd(Auth::user());
            // dd(auth()->user()->id);
            $session->user_id = $request->user_id;
            $session->mentor_id = auth()->user()->id;
            $session->theme_evenement = $request->theme_evenement;
            $session->date_evenement = $request->date_evenement;
            $session->lieu =$request->lieu;
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
