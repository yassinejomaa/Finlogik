<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
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
        $transaction = new Transaction
        ([ 
            'actif' => $request->input('actif'), 
            'TypeTransaction' => $request->input('TypeTransaction'), 
            'quantuite' => $request->input('quantuite'),
            'date' => $request->input('date'), 
            'prixTotal' => $request->input('prixTotal'), 
            'limitBuy' => $request->input('limitBuy'), 
            'limitBuyPrice' => $request->input('limitBuyPrice'), 
            'userID' => $request->input('userID'), 
            'porteFeuilleID'=> $request->input('porteFeuilleID'), 
            'buyOrsell' => $request->input('buyOrsell'),  
        ]); 
        $transaction->save(); 
 
        return response()->json($transaction,201);
    }
    public function nbreTransactionLimitBuy(){
        $nbre=Transaction::where('TypeTransaction','Limit Buy')->count();
        return $nbre;
    }
    public function nbreTransactionMarketBuy(){
        $nbre=Transaction::where('TypeTransaction','Market Buy')->count();
        return $nbre;
    }
    public function nbreTransaction(){
        $nbre=Transaction::count();
        return $nbre;
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function getLimitBuy($userID)
{
    $transactions = Transaction::where('userID', $userID)
                                ->where('limitBuy', 1)
                                ->get();
    
    return response()->json($transactions);
}
public function setLimitBuy($idtransaction)
{
    $transaction = Transaction::find($idtransaction);

    if (!$transaction) {
        return response()->json([
            'message' => 'Transaction not found'
        ], 404);
    }

    $transaction->limitBuy = 0;
    $transaction->prixTotal = $transaction->limitBuyPrice*$transaction->quantuite ;
    $transaction->save();

    return response()->json([
        'message' => 'Transaction updated successfully!',
        'transaction' => $transaction
    ], 200);
}
public function getQuantiteParActifEtTypeTransaction($porteFeuilleID)
{
    $result = Transaction::select(
            'actif',
            DB::raw('SUM(CASE WHEN buyOrsell = "buy" AND (limitBuy = 0 OR limitBuy IS NULL) THEN quantuite ELSE 0 END) as total_buy'),
            DB::raw('SUM(CASE WHEN buyOrsell = "sell" THEN quantuite ELSE 0 END) as total_sell')
        )
        ->where('porteFeuilleID', $porteFeuilleID) // Filtrer par porteFeuilleID
        ->groupBy('actif')
        ->get();

    return response()->json($result);
}



}
