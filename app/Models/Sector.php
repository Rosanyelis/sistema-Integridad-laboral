<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'municipality_id',
        'name',
    ];
    
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
    
    
    

}
