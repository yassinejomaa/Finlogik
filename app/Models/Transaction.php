<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'actif','TypeTransaction' ,'quantuite','date' ,'prixTotal','limitBuy','limitBuyPrice' ,'userID','porteFeuilleID','buyOrsell' 
    ]; 
    public function users() {  
        return $this->belongsTo(User::class,"userID");  
            } 
     public function porteFeuilles() {  
        return $this->belongsTo(porteFeuilleVirtuel::class,"porteFeuilleID");  
         } 
}
