<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRank extends Model
{
    public $table = 'company_student_rank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'student_id',
        'rank'
    ];

    public function student()
    {
        return $this->hasOne(Student::class,'id', 'student_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class,'id', 'company_id');
    }
}
