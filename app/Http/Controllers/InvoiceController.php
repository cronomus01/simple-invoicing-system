<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::get();
        return view('invoice', ['invoices' => $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.invoice-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice = new Invoice;

        $invoice->type = $request->type;
        $invoice->product_service = $request->product_service;
        $invoice->quantity = $request->quantity;
        $invoice->base_price = $request->base_price;
        $invoice->subtotal = $request->base_price * $request->quantity;

        // DB::transaction(function ($request, $invoice) {
            $invoice->save();
        // });

        return redirect('/invoices');
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
        $invoice = Invoice::find($id);

        return view('invoices.invoice-edit', ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $invoice = Invoice::find($id);

        if($invoice) {
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
