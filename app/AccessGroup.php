<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class AccessGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accessgroups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The Users that belong to the accessgroup/role.
     * Many to Many Relationship , via third table, 
     */
    public function Users()
    {
        return $this->belongsToMany('App\User', 'user_accessgroups', 'accessgroup_id', 'user_id')->withTimestamps();;
    }

}
