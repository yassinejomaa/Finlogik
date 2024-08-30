<?php

namespace App\Http\Controllers;

use App\Models\porteFeuilleVirtuel;
use Illuminate\Http\Request;

class PorteFeuilleVirtuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $porteFeuilleVirtuel = new porteFeuilleVirtuel
        ([ 
            'nom' => $request->input('nom'), 
            'valeur' => $request->input('valeur'), 
            'userID' => $request->input('userID') 
        ]); 
        $porteFeuilleVirtuel->save(); 
 
        return response()->json($porteFeuilleVirtuel,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(porteFeuilleVirtuel $porteFeuilleVirtuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, porteFeuilleVirtuel $porteFeuilleVirtuel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(porteFeuilleVirtuel $porteFeuilleVirtuel)
    {
        //
    }
    public function getPortefeuilleUser($idUser)
    {
        $porteFeuilleVirtuels = porteFeuilleVirtuel::where('userID', $idUser)
                                    
                                    ->get();
        
        return response()->json($porteFeuilleVirtuels);
    }
    public function getPortefeuille($id)
    {
        $porteFeuilleVirtuels = porteFeuilleVirtuel::where('id', $id)
                                    
                                    ->get();
        
        return response()->json($porteFeuilleVirtuels);
    }
    public function setValeur($id, $val)
{
    // Fetch the first matching record
    $porteFeuilleVirtuel = porteFeuilleVirtuel::where('id', $id)->first();

    // Check if the record exists
    if (!$porteFeuilleVirtuel) {
        return response()->json([
            'message' => 'Porte feuille not found'
        ], 404);
    }
    

    // Update the valeur field
    $porteFeuilleVirtuel->valeur = $porteFeuilleVirtuel->valeur - $val;
    $porteFeuilleVirtuel->save(); // Save the updated model

    // Return success response
    return response()->json([
        'message' => 'Porte feuille updated successfully!',
        'porteFeuilleVirtuel' => $porteFeuilleVirtuel // return the updated model
    ], 200);
}
public function sell($id, $val)
{
    // Fetch the first matching record
    $porteFeuilleVirtuel = porteFeuilleVirtuel::where('id', $id)->first();

    // Check if the record exists
    if (!$porteFeuilleVirtuel) {
        return response()->json([
            'message' => 'Porte feuille not found'
        ], 404);
    }

    // Update the valeur field
    $porteFeuilleVirtuel->valeur = $porteFeuilleVirtuel->valeur+ $val;
    $porteFeuilleVirtuel->save(); // Save the updated model

    // Return success response
    return response()->json([
        'message' => 'Porte feuille updated successfully!',
        'porteFeuilleVirtuel' => $porteFeuilleVirtuel // return the updated model
    ], 200);
}


    

}
