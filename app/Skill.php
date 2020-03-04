<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'specialization_id'
    ];
}
