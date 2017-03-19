<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    protected $table = 'userStats';

public $timestamps = false;
    //
public function user()
    {
        return $this->belongsTo('App\User');
    }
}
