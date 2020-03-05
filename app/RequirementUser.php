<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementUser extends Model
{
    protected $fillable = ['requirement_id', 'user_id', 'status'];
}
