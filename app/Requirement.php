<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = [
        'name',
        'link',
        'specialization_id'
    ];

    public function specialization()
    {
        return $this->belongsTo('App\Specialization');
    }
}
