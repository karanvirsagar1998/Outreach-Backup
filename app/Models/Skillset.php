<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
    public $table = 'skillset';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];
}
