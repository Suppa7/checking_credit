<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    protected $fillable = [
        'curriculum_type_id',
        'subject_category_id'
    ];
    //
    public function subject_category()
    {
        return $this->belongsTo(SubjectCategory::class);
    }

    public function curriculum_type()
    {
        return $this->belongsTo(CurriculumType::class);
    }
}
