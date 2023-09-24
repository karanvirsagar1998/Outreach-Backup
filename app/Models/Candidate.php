<?php

namespace App\Models;

use App\Traits\HasAdvancedFilter;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasAdvancedFilter;

    protected $fillable = ['student_id', 'job_id', 'rank', 'status'];
    protected $appends = [
        'resume',
    ];

    protected $filterable = [
        'status',
        'student.first_name',
        'student.email',
        'student.skills',
        'job.id'
    ];
    protected $orderable = [
        'id',
        'student.first_name',
        'student.email',
        'student.availability',
        'student.international',
        'job.name',
        'rank'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->with('student');
    }

    public function student()
    {
        return $this->belongsTo(Student::class)->with('college');
    }

    public function job()
    {
        return $this->belongsTo(Jobs::class);
    }

    public function getResumeAttribute()
    {
        return $this->getMedia('resume')->map(function ($item) {
            $media = $item->toArray();
            $media['url'] = $item->getUrl();
            return $media;
        })->last();
    }
}
