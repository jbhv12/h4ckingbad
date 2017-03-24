<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Problem;

class Problem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'problems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'abstraction',
        'minorhint',
        'majorhint',
        'flag',
        'problempageurl',
        'problemfilespath',
    ];

    /**
     * Get the Category for the problem.
     * One to Many Relationship(Inverse) , this table has foreign key
     */
    public function Category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }


    /**
     * The Users that belong to the problem.
     * Many to Many Relationship , via third table, 
     */
    public function Users()
    {
        return $this->belongsToMany('App\User', 'problems_by_users', 'problem_id', 'user_id')->withPivot('hastried','hastakenminorhint','hastakenmajorhint','time','points')->withTimestamps();;
    }
}
