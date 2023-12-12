<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $fillable = ['invoice_number', 'invoice_date', 'customer_id'];

    public function storeInvoice(Request $request)
    {
        $uuid = Str::uuid()->toString();

        $this->fill([
            'invoice_number' => $uuid,
            'invoice_date' => now(),
            'customer_id' => $request->input('customer_id')
        ]);

        return $this->save();
    }

    public function getOneInvoice($id): Invoice
    {
        return $this->find($id);
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
}
