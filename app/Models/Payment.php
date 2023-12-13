<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'or_number',
        'amount_paid',
        'type_of_payment',
        'payment_record_number',
        'payment_date'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
