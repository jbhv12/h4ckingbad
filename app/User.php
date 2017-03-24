<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\UserProfile;
use App\AccessGroups;
use App\Round;
use App\Problem;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the UserProfile record associated with the user.
     * One to One Relationship , this table has primary key
     */
    public function UserProfile()
    {
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }

    /**
     * The roles/groups that belong to the user.
     * Many to Many Relationship , via third table, 
     */
    public function AccessGroups()
    {
        return $this->belongsToMany('App\AccessGroup', 'user_accessgroups', 'user_id', 'accessgroup_id')->withTimestamps();;
    }

    /**
     * The Rounds that belong to the user.
     * Many to Many Relationship , via third table, 
     */
    public function Rounds()
    {
        return $this->belongsToMany('App\Round', 'users_in_rounds', 'user_id', 'round_id')->withPivot('starttime','endtime')->withTimestamps();;
    }

    /**
     * The Problems that belong to the user.
     * Many to Many Relationship , via third table, 
     */
    public function Problems()
    {
        return $this->belongsToMany('App\Problem', 'problems_by_users', 'user_id', 'problem_id')->withPivot('hastried','hastakenminorhint','hastakenmajorhint','time','points')->withTimestamps();;
    }
}
