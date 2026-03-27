<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumType extends Model
{
    protected $fillable = [
        'curriculum_id',
        'type_name',
        'submajor_id',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function curriculum_subject()
    {
        return $this->hasMany(CurriculumSubject::class);
    }

    public function submajor_measure()
    {
        return $this->hasMany(SubmajorMeasure::class);
    }

    public function submajor()
    {
        return $this->belongsTo(Submajor::class);
    }
}
