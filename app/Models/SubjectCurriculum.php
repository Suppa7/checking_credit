<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectCurriculum extends Model
{
    protected $table = 'subject_curriculum';
    /**
     * 
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'curriculum_id'
    ];
    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
