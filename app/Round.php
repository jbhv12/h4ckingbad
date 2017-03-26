<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\User;

class Round extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'maxtime',
    ];

    /**
     * The Categories that belong to the round.
     * Many to Many Relationship , via third table, 
     */
    public function Categories()
    {
        return $this->belongsToMany('App\Category', 'categories_in_rounds', 'round_id', 'category_id'))->withPivot('id','total_problems')->withTimestamps();
    }

    /**
     * The Users that belong to the Round.
     * Many to Many Relationship , via third table, 
     */
    public function Users()
    {
        return $this->belongsToMany('App\User', 'users_in_rounds', 'round_id', 'user_id')->withPivot('id','starttime','endtime')->withTimestamps();;
    }
}
