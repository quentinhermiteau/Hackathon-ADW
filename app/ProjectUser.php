<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillable = [
        "user_id",
        "project_id",
        "positioned"
    ];

    protected $hidden = [
        "created_at",
        "id",
        "updated_at"
    ];
}
