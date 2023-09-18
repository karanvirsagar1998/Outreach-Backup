<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public $table = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'contact_number',
        'email',
        'link',
        'about',
        'skills',
        'rank',
        'availability',
        'international',
        'college_id',
        'college_other',
        'video_link',
        'assessment_results_link'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function skillsets()
    {
        return $this->hasMany(StudentSkillset::class);
    }

    /**
     * Get corresponding college.
     */
    public function college()
    {
        return $this->hasOne(College::class,'id', 'college_id');
    }
}
