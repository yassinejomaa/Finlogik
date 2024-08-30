<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temoignage extends Model
{
    use HasFactory;
    protected $fillable = [
        'textTemoignage',
        'statu',
        'UserId'
        ];
        public function user()
        {
            return $this->belongsTo(User::class,"UserId");
        }
}
