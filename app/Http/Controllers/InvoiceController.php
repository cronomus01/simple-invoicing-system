<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use App\Models\InvoiceTotal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
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
        $customers = User::all();
        $invoices = Invoice::all();
        return view('invoices.invoice-create', compact('invoice_number', 'customers', 'invoices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); //Start transaction

            Invoice::create([
                'invoice_number' => $request->invoice,
                'invoice_date' => now(),
                'customer_id' => intval($request->customer_id)
            ]);

            DB::commit(); //Save changes

        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
        }

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
        $invoice = Invoice::find($id);
        $invoices = Invoice::all();
        $customers = User::all();
        $users = User::get();

        return view('invoices.invoice-edit', compact('invoice', 'invoices', 'users', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grandPrice = 0;

        try {
            DB::beginTransaction();
            // Update invoice customer
            Invoice::where('id', $id)->update([
                'customer_id' => $request->customer_id
            ]);

            Db::commit();
        } catch (\Exception $e) {

            report($e);

            DB::rollBack(); // <= Rollback in case of an exception
        }

        if (is_array($request->type)) {

            foreach ($request->type as $key => $value) {

                try {
                    DB::beginTransaction(); // <= Starting the transaction

                    $grandPrice += intval($request->quantity[$key]) * intval($request->base_price[$key]);

                    $invoiceItem = InvoiceItem::where('id', intval($request->invoice_item[$key]))->first();

                    if (!$invoiceItem) {
                        // Insert a new invoice item
                        InvoiceItem::create([
                            'invoice_id' => $id,
                            'type' => $value,
                            'product_service' => $request->product_service[$key],
                            'quantity' => intval($request->quantity[$key]),
                            'base_price' => intval($request->base_price[$key]),
                            'subtotal' => intval($request->quantity[$key]) * intval($request->base_price[$key]),
                        ]);
                    } else {
                        $invoiceItem->update([
                            'invoice_id' => $id,
                            'type' => $value,
                            'product_service' => $request->product_service[$key],
                            'quantity' => intval($request->quantity[$key]),
                            'base_price' => intval($request->base_price[$key]),
                            'subtotal' => intval($request->quantity[$key]) * intval($request->base_price[$key]),
                        ]);
                    }

                    DB::commit(); // <= Commit the changes
                } catch (\Exception $e) {
                    report($e);
                    DB::rollBack(); // <= Rollback in case of an exception
                }


            }
        }

        try {
            DB::beginTransaction();
            // Update invoice customer
            $invoiceTotal = InvoiceTotal::where('invoice_id', $id)->first();

            if (!$invoiceTotal) {
                InvoiceTotal::create([
                    'invoice_id' => $id,
                    'grand_price' => $grandPrice
                ]);
            } else {
                $invoiceTotal->update([
                    'grand_price' => $grandPrice
                ]);
            }

            Db::commit();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            report($e);

            DB::rollBack(); // <= Rollback in case of an exception
        }

        return redirect()->route('invoice.edit', ['invoice' => $id]);
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
