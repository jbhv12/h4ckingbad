<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccessGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_accessgroups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'accessgroup_id',
    ];
}
