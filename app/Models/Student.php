<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'student_name',
        'major_id',
        'submajor_id'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
