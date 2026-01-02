<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    //
    public function subject_category()
    {
        return $this->belongsTo(SubjectCategory::class);
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
