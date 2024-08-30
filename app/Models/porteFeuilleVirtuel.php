<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class porteFeuilleVirtuel extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'nom','valeur' ,'userID' 
    ]; 
    public function users() {  
        return $this->belongsTo(User::class,"userID");  
  } 
}
