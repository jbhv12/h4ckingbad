<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInRound extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_in_rounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'round_id',
        'starttime',
        'endtime',
    ];
}
