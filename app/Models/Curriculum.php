<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $fillable = [
        'program_name',
        'curriculum_name',
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
}
