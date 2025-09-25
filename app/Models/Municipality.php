<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
    ];
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}
