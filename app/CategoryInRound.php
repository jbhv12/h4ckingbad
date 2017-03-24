<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryInRound extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories_in_rounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'round_id',
        'total_problems',
    ];
}
