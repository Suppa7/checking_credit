<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectCategory extends Model
{
    //
    public function subject_type()
    {
        return $this->hasMany(SubjectType::class);
    }

    public function curriculum_subject()
    {
        return $this->hasOne(CurriculumSubject::class);
    }
}
