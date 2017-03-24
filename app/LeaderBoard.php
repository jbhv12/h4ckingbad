<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderBoard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leaderboards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_in_round_id',
        'time',
        'points',
        'position',
    ];
}
