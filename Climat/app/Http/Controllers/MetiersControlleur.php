<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metier;  // Assurez-vous d'importer le modèle Metier
use Validator;
use App\Models\User;
use App\Notifications\MetierUpdated;



class MetiersController extends Controller
{
    //
// Afficher le formulaire de modification
// Afficher le formulaire de modification
// Afficher le formulaire de modification
public function edit($id)
{
    // Vérifier si le métier existe
    $metier = Metier::find($id);
    
    if (!$metier) {
        return redirect()->route('metiers.index')->with('error', 'Métier non trouvé');
    }

    // Retourner la vue avec les données du métier
    return view('edit', compact('metier'));
}

    
    // Mettre à jour le métier
    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'code_metier' => 'required|string|max:255',
            'nom_usuel' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
            'code_postal' => 'nullable|string|max:255',
            'code_insee' => 'nullable|string|max:255',
            'code_dpt' => 'nullable|string|max:10',
            'code_reg' => 'nullable|string|max:255',
            'nom_commune' => 'nullable|string|max:255',
            'x_wgs84' => 'nullable|numeric',
            'y_wgs84' => 'nullable|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid data',
                'errors' => $validator->errors()
            ], 400);
        }
    
        // Vérifier si le métier existe
        $metier = Metier::find($id);
    
        if (!$metier) {
            return response()->json([
                'status' => 'error',
                'message' => 'Metier not found'
            ], 404);
        }
    
        // Mettre à jour les données
        $metier->update($request->all());

        // Trouver l'utilisateur (ou administrateur) qui doit recevoir la notification
        $user = User::find(1); // Exemple avec l'ID de l'utilisateur, tu peux aussi récupérer un admin

        // Envoyer la notification
        $user->notify(new MetierUpdated($metier));
    
        // Retourner un message de succès
        return response()->json([
            'status' => 'success',
            'message' => 'Metier updated successfully',
            'data' => $metier
        ]);
    }
    
}
