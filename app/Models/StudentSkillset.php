<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSkillset extends Model
{
    public $table = 'student_skillset';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'skillset_id',
        'total_years_experience'
    ];

    public function skill()
    {
        return $this->hasOne(Skillset::class,'id', 'skillset_id');
    }

    public function company()
    {
        return $this->hasOne(Student::class,'id', 'student_id');
    }

}
