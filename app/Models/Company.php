<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Company extends Model
{
    public $table = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'job_description',
        'link',
        'email',
        'contact_number',
        'source',
        'other_specify',
        'status',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(student::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function skillsets()
    {
        return $this->hasMany(CompanySkillset::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function rankings()
    {
        return $this->hasMany(StudentRank::class);
    }
}
