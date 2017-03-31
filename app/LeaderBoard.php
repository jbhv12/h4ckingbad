<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderBoard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leaderboards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_in_round_id',
        'time',
        'points',
        'position',
    ];

    /**
     * Get Hours from the time
     *
     */
    public function getHours(){
        $init = $this->time;
        $hours = floor($init / 3600);

        return $hours;
    }
    
    /**
     * Get Minutes from the time
     *
     */
    public function getMinutes(){
        $hours = $this->getHours();
        $minutes = floor(($this->time - ($hours * 3600)) / 60);
        return $minutes;
    }
    /**
     * Get Seconds from the time
     *
     */
    public function getSeconds(){
        $hours = $this->getHours();
        $hMin = $this->time - ($hours * 3600);
        $minutes = $this->getMinutes();
        $seconds = $hMin - ($minutes * 60);
        return $seconds;
    }

    public function UserInRound()
    {
        return $this->belongsTo('App\UserInRound', 'user_in_round_id', 'id');
    }
}
