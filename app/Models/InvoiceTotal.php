<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTotal extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'discount', 'vat', 'grand_price'];
}
