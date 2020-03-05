<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function skills()
    {
        return $this->hasMany('App\Skill');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }
}
