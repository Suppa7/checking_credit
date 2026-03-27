<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_code',
        'subject_name',
        'subject_credit',
        'subject_type_id',
        'subject_own_id'
    ];

    public function subject_type()
    {
        return $this->belongsTo(SubjectType::class);
    }

    public function subject_own()
    {
        return $this->belongsTo(SubjectOwn::class);
    }

    public function subject_curriculum()
    {
        return $this->hasMany(SubjectCurriculum::class);
    }

    public function curriculums()
    {
        return $this->belongsToMany(Curriculum::class, 'subject_curriculum');
    }
}
