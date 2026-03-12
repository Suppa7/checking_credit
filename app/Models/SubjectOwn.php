<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectOwn extends Model
{
    protected $fillable = [
        'major_id',
        'submajor_id'
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function submajor()
    {
        return $this->belongsTo(Submajor::class);
    }
}
