<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
