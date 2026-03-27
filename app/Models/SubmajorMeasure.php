<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmajorMeasure extends Model
{
    protected $fillable = [
        'curriculum_type_id',
        'submajor_id',
        'type'
    ];
    
    public function curriculumType()
    {
        return $this->belongsTo(CurriculumType::class);
    }
    public function submajor()
    {
        return $this->belongsTo(Submajor::class);
    }
}
