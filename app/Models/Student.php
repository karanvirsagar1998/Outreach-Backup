<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAdvancedFilter;

class Student extends Model
{

    use HasAdvancedFilter;
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
        'assessment_results_link',
        'status'
    ];

    protected $filterable = [
        'status',
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
        'assessment_results_link',
        'status'
    ];

    protected $orderable = [
        'id',
        'status',
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
        'assessment_results_link',
        'status'
    ];

    protected $casts = [
        'skills' => 'json',
    ];

    protected $appends = [
        'completeSkills'
    ];

    public function getCompleteSkillsAttribute() {
        $skillsetArr = collect();
        if ($this->attributes['skills']) {
            $skillsetArr = collect($this->skills);
        }

        if (count($this->skillsets)) {
            foreach ($this->skillsets as $skills) {
                array_push($skillsetArr, $skills->skill->name);
            }
        }

        if ($skillsetArr->count()) {
            return $skillsetArr->join(", ");
        } else {
            return "";
        }
    }


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
