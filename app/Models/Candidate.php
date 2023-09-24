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

    protected $fillable = ['user_id', 'job_id', 'rank', 'status'];
    protected $appends = [
        'resume',
    ];

    protected $filterable = [
        'status'
    ];
    protected $orderable = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->with('student');
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
