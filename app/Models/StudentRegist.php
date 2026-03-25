<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegist extends Model
{
    /**
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subject_id',
        'status',
    ];
    //
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
