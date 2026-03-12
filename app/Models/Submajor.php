<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submajor extends Model
{
    protected $fillable = [
        'submajor_id',
        'submajor_name_thai',
        'major_id'
    ];
    
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
