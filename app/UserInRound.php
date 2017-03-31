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
        'hasstarted',
        'starttime',
        'endtime',
    ];

    /**
     * Get the User record that own this userprofile.
     * One to One Relationship , this table has foreign key
     */
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Round()
    {
        return $this->belongsTo('App\Roud', 'round_id', 'id');
    }
}
