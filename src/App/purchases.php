<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class purchases extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'supplier_id', 'invoice_date', 'invoice_due', 'status', 'net_total', 'tax_total', 'grand_total', 'invoice_ref',
    ];
}
