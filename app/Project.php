<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'realisation_date',
        'status',
        'client_name',
        'contact_firstname',
        'contact_lastname',
        'contact_phone_number',
        'budget_min',
        'budget_max',
        'user_id',
        'referent_id'
    ];

    public function specializations()
    {
        return $this->belongsToMany('App\Specialization');
    }

    public function referent()
    {
        return $this->belongsTo('App\User', 'referent_id');
    }
}
