<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
