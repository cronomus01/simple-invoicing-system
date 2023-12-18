<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use App\Models\InvoiceTotal;
use App\Models\Payment;
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
        $invoice = Invoice::first();
        $payment = Payment::first();

        return view('invoices.invoice-create', compact('invoice_number', 'customers', 'invoices', 'invoice', 'payment'));
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
        $payment = Payment::latest()->first();
        $invoices = Invoice::orderBy('id', 'desc')->get();
        $customers = User::all();
        $users = User::get();
        $invoiceLatest = Invoice::latest()->first();

        $discount = 0;
        $total = $invoice->items->sum('subtotal');

        if ($invoice->total) {
            $discount = $total * $invoice->total->discount / 100;
        }

        $discountedPrice = $total - $discount;


        return view('invoices.invoice-edit', compact('invoice', 'invoices', 'users', 'customers', 'discountedPrice', 'payment', 'invoiceLatest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grandPrice = 0;

        $invoice = Invoice::where('id', $id)->first();

        try {
            DB::beginTransaction();
            // Update invoice customer
            $invoice->update([
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

            // Vat without discount
            $vat = $grandPrice * 0.12;

            $discount = $grandPrice * intval($request->discount) / 100;

            // Current price with discount
            $grandPrice = ($grandPrice - $discount);

            // Vat with discount
            if ($request->discount) {
                $vat = $grandPrice * 0.12;
            }

            // Overall price
            $grandPriceWithVat = ($grandPrice * 0.12) + $grandPrice;

            if (count($invoice->items->all()) > 0 && !$invoiceTotal) {
                InvoiceTotal::create([
                    'invoice_id' => $id,
                    'grand_price' => $grandPriceWithVat,
                    'discount' => intval($request->discount),
                    'vat' => $vat,
                ]);
            }

            if ($invoiceTotal) {
                $invoiceTotal->update([
                    'grand_price' => $grandPriceWithVat,
                    'discount' => intval($request->discount),
                    'vat' => $vat,
                ]);
            }

            Db::commit();
        } catch (\Exception $e) {
            // throw new \Exception($e->getMessage());
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
