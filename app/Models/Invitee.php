<?php

namespace App\Models;
use App\Traits\HasAdvancedFilter;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
    use HasAdvancedFilter;
    protected $fillable = ['job_id','test_id','email', 'link_activation_time','link_expiry_time','reply_to', 'status'];

    public function job()
    {
        return $this->belongsTo(Jobs::class);
    }
}