<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_payement',
        'id_generate',
        'uuid',
        'phone',
        'amount',
        'currency',
        'type',
        'method',
        'numero',
        'plateform',
        'country',
        'url_callback',
        'payment_link',
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