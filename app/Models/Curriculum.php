<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    //
    /**
     * 
     * 
     * @var string
     */
    protected $table = 'curriculums';

    public function curriculum_subject()
    {
        return $this->hasMany(CurriculumSubject::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
