<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEvenementRequest;
use App\Http\Requests\EditEvenementRequest;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class EvenementController extends Controller
{
    public function index(Evenement $evenement)
    {
        try {
            if ($evenement->est_archive == 0) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des evenements non archivés',
                    'evenement' => Evenement::where('est_archive', 0)->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function archive(Evenement $evenement)
    {
        try {
            $evenement->update([
                'est_archive' => 1,
            ]);
            $evenement->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => "L'événement a été archivé",
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function EvenementArchive(Evenement $evenement)
    {
        try {
            if ($evenement->est_archive == 0) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des evenements  archivés',
                    'evenement' => Evenement::where('est_archive', 1)->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(CreateEvenementRequest $request)
    {
        try {
            $evenement = new Evenement();
            $evenement->libelle = $request->libelle;
            $evenement->description = $request->description;
            $evenement->date_evenement = $request->date_evenement;
            $evenement->heure_evenement = $request->heure_evenement;
            $evenement->lieu = $request->lieu;
            $evenement->image = $this->storeImage($request->image);
            $evenement->save();
            return response()->json([
                'status_code' => 200, //Pour montrer que la réquete a été effectuer
                'status_message' => 'L\'événement a été ajouter',
                'evenement' => $evenement
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    private function storeImage($image)
    {
        return $image->store('evenementImage', 'public');
    }

    public function update(EditEvenementRequest $request, Evenement $evenement)
    {
        try {
            $evenement->libelle = $request->libelle;
            $evenement->description = $request->description;
            $evenement->date_evenement = $request->date_evenement;
            $evenement->heure_evenement = $request->heure_evenement;
            $evenement->lieu = $request->lieu;

            if ($request->hasFile("image")) {
                $evenement->image = $this->storeImage($request->image);
            }
            $evenement->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'événement a été modifier',
                'evenement' => $evenement
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Evenement $evenement)
    {
        try {
            $evenement->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'événement a été supprimer',
                'evenement' => $evenement
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
