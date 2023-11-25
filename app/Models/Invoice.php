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
    protected $fillable = ['invoice_number', 'invoice_date'];

    public function storeInvoice(Request $request)
    {
        $uuid = Str::uuid()->toString();

        $this->fill([
            'invoice_number' => $uuid,
            'invoice_date' => now(),
        ]);

        $this->save();
    }

    public function getInvoices(): Collection
    {
        return $this->get();
    }

    public function getOneInvoice($id): Invoice
    {
        return $this->find($id);
    }
}
