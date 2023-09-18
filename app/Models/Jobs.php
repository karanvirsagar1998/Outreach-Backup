<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Jobs extends Model
{
    public $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
