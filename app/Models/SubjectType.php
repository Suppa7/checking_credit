<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    protected $fillable = ['subject_category_id', 'credit_needed', 'type_name'];
    public function subject_category()
    {
        return $this->belongsTo(SubjectCategory::class,'subject_category_id','id');
    }
}
