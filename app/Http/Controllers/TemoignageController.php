<?php

namespace App\Http\Controllers;

use App\Models\temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temoignage=Temoignage::with('user')->get();
        return $temoignage;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tem = new Temoignage([
            'textTemoignage' => $request->input('textTemoignage'),
            'statu' => $request->input('statu'),
            'UserId' => $request->input('UserId')
            ]);
            $tem->save();
            
            return response()->json($tem, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Temoignage $temoignage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Temoignage $temoignage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tem = Temoignage::find($id);
        $tem->delete();
        return response()->json('Temoignage supprimée !');
    }

    public function accepte($id)
    {
        $tem = Temoignage::find($id);
        $tem->statu="active";
        
         $tem->save();
            
        return response()->json($tem, 201);
    }
    public function refuse($id)
    {
        $tem = Temoignage::find($id);
        $tem->statu="inactive";
        
         $tem->save();
            
        return response()->json($tem, 201);
    }

    public function tmoignageMain()
    {
        $temoignage=Temoignage::where('statu','active')->with('user')->get();
        return $temoignage;
    }
    public function nbreElement(){
        $nbre=Temoignage::count();
        return $nbre;
    }
    public function nbreTemoiActive(){
        $nbre=Temoignage::where('statu','active')->count();
        return $nbre;
    }
    public function nbreTemoiNonActive(){
        $nbre=Temoignage::where('statu','inactive')->count();
        return $nbre;
    }

}
