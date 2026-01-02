<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    public function subject_category()
    {
        return $this->belongsTo(SubjectCategory::class,'subject_category_id','id');
    }
}
