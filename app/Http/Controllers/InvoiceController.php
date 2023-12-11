<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public $invoice;
    /**
     * Display a listing of the resource.
     */

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    public function index()
    {
        $invoices = $this->invoice->getInvoices();
        return view('invoice', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $invoice_number = Str::uuid();
        $customers = User::get()->all();
        $invoices = Invoice::all();
        return view('invoices.invoice-create', compact('invoice_number', 'customers', 'invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->invoice->storeInvoice($request);

        return redirect('dashboard');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = $this->invoice->getOneInvoice($id);
        $invoices = $this->invoice->getInvoices();
        $users = User::get();

        return view('invoices.invoice-edit', compact('invoice', 'invoices', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->update([
                'type' => $request->type,
                'product_service' => $request->product_service,
                'quantity' => $request->quantity,
                'base_price' => $request->base_price,
                'subtotal' => $request->base_price * $request->quantity,
            ]);
        }

        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('/invoices');
    }
}
