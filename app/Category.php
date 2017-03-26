<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Round;
use App\Problem;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'points',
    ];

    /**
     * The Rounds that belong to the category.
     * Many to Many Relationship , via third table, 
     */
    public function Rounds()
    {
        return $this->belongsToMany('App\Round', 'categories_in_rounds', 'category_id', 'round_id'))->withPivot('id','total_problems')->withTimestamps();
    }

    /**
     * Get the Problems for the category.
     * One to Many Relationship , this table has primary key
     */
    public function Problems()
    {
        return $this->hasMany('App\Problem', 'category_id', 'id');
    }

}
