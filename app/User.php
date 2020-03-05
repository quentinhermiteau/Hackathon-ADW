<?php

declare(strict_types=1);

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'birthday',
        'description',
        'role',
        'status',
        'specialization_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstName} {$this->lastname}";
    }

    public function specialization()
    {
        return $this->belongsTo('App\Specialization');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'agent_id');
    }

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement', 'requirement_users');
    }
}
