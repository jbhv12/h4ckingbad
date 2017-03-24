<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
