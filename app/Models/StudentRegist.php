<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegist extends Model
{
    //
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }
}
