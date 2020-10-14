<?php

namespace duncanrmorris\purchases\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class suppliers extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
    ];
}
