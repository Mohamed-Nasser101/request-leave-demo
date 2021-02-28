<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    //Assign a new role to the user

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

    //Fetch the user's abilities
    
    public function abilities()
    {
        return $this->roles
            ->map->abilities
            ->flatten()->pluck('name')->unique();
    }

    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function annualLeaves(){
        return $this->leaves->where('type_id',1);
    }

    public function annualDaysOff(){
        $days = 0;
        $leaves = $this->annualLeaves();
        $leaves->each(function($leave) use (&$days) {
            $to = Carbon::parse($leave->to);
            $from = Carbon::parse($leave->from);
            $days += ($from->diffInDays($to)); 
        });

        return $days;
    }

    public function sickLeaves(){
        return $this->leaves->where('type_id',2);
    }

    public function sickDaysOff(){
        $days = 0;
        $leaves = $this->sickLeaves();
        $leaves->each(function($leave) use (&$days) {
            $to = Carbon::parse($leave->to);
            $from = Carbon::parse($leave->from);
            $days += ($from->diffInDays($to)); 
        });

        return $days;
    }

    public function urgentLeaves(){
        return $this->leaves->where('type_id',2);
    }

    public function urgentDaysOff(){
        $days = 0;
        $leaves = $this->urgentLeaves();
        $leaves->each(function($leave) use (&$days) {
            $to = Carbon::parse($leave->to);
            $from = Carbon::parse($leave->from);
            $days += ($from->diffInDays($to)); 
        });

        return $days;
    }

    
}
