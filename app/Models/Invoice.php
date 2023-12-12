<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_number', 'invoice_date', 'customer_id'];

    public $timestamps = true;

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function total()
    {
        return $this->hasOne(InvoiceTotal::class, 'invoice_id', 'id');
    }
}
