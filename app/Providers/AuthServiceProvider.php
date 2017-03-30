<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-userprofile', function ($user, $userprofile) {
            return ($user->isAdmin() || $user->UserProfile->id == $userprofile->id);
        });
        Gate::define('edit-userprofile', function ($user, $userprofile) {
            return ($user->isAdmin() || $user->UserProfile->id == $userprofile->id);
        });

        Gate::define('index-participantround', function ($user, $id) {
            return $user->id == $id;
        });
        Gate::define('participantround', function ($user, $id, $round) {
            return $user->id == $id->id && $user->Rounds->contains($round);
        });

        Gate::define('index-participantproblem', function ($user, $id) {
            $current = Carbon::now();
            $starttime = Carbon::parse(session('starttime'));
            $endtime = Carbon::parse(session('endtime'));
            if( !($current->between($starttime,$endtime)) ){
                session()->forget('round');
                session()->forget('user_in_round');
                session()->forget('leaderboard');
                session()->forget('starttime');
                session()->forget('endtime');
                return false;
            }
            return session()->has('user_in_round') && $user->id == $id;
        });

        Gate::define('show-participantproblem', function ($user, $id, $problem) {
            $current = Carbon::now();
            $starttime = Carbon::parse(session('starttime'));
            $endtime = Carbon::parse(session('endtime'));
            if( !($current->between($starttime,$endtime)) ){
                session()->forget('round');
                session()->forget('user_in_round');
                session()->forget('leaderboard');
                session()->forget('starttime');
                session()->forget('endtime');
                return false;
            }
            return session()->has('user_in_round') && $user->id == $id->id && $user->Problems->contains($problem);
        });
        
    }
}
