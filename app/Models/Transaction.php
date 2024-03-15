<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_lastname',
        'customer_firstname',
        'plateform',
        'amount',
        'description',
        'payment_link',
        'number',
        'id_generate',
        'uuid',
        'phone',
        'currency',
        'type',
        'method',
        'country',
        'url_callback',
        'payment_date',
        'expiration_time',
        'status',
    ];

    public function isValid()
    {
        if ($this->expiration_time < Carbon::now()) {
            return false;
        }

        if ($this->status !== 'PENDING') {
            return false;
        }

        return true;
    }
}