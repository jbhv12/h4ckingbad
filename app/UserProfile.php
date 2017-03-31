<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class UserProfile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userprofiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'teamname',
        'firstmembername',
        'secondmembername',
        'firstmemberemail',
        'secondmemberemail',
        'firstmembermobile',
        'secondmembermobile',
    ];

    /**
     * Get the User record that own this userprofile.
     * One to One Relationship , this table has foreign key
     */
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
