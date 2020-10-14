<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class purchases_lines extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'supplier_id','qty', 'description', 'line_price', 'line_net', 'line_tax', 'line_total', 'tax_exempt',
    ];
}
