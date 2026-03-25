<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumType extends Model
{
    protected $fillable = [
        'curriculum_id',
        'type_name',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function curriculum_subject()
    {
        return $this->hasMany(CurriculumSubject::class);
    }
}
