<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProblemByUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'problems_by_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'problem_id',
        'hastried',
        'hastakenminorhint',
        'hastakenmajorhint',
        'time',
        'points',
    ];
}
