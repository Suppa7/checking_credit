<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $fillable = [
        'major_id',
        'curriculum_year'
    ];
    //
    /**
     * 
     * 
     * @var string
     */
    protected $table = 'curriculums';

    public function curriculum_type()
    {
        return $this->hasMany(CurriculumType::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function subject_curriculum()
    {
        return $this->hasMany(SubjectCurriculum::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
