<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['mark', 'comment', 'status', 'reviewer_id', 'agent_id'];

    public function reviewer(): User
    {
        return $this->hasOne('App\User', 'reviewer_id');
    }

    public function agent(): User
    {
        return $this->hasOne('App\User', 'agent_id');
    }
}
