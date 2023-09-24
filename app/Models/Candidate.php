<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Candidate extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['user_id', 'job_id', 'rank', 'status'];
    protected $appends = [
        'resume',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
