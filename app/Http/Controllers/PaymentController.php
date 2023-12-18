<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoiceId = request()->get('invoice');
        $invoices = Invoice::all();
        $invoice = Invoice::find($invoiceId);
        $payment = Payment::first();

        $discount = 0;
        $total = $invoice->items->sum('subtotal');

        if ($invoice->total) {
            $discount = $total * $invoice->total->discount / 100;
        } else {
            return redirect()->route('invoice.edit', ['invoice' => $invoiceId]);
        }

        $discountedPrice = $total - $discount;
        $paymentNumber = Str::uuid();

        return view('payment.payment-create', compact('invoices', 'invoice', 'discountedPrice', 'paymentNumber', 'payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice = Invoice::where('id', $request->invoice_id)->first();
        $createdPayment = null;
        try {
            DB::beginTransaction();
            // Update invoice customer
            $createdPayment = Payment::create([
                'type_of_payment' => $request->payment_type,
                'invoice_id' => $request->invoice_id,
                'payment_record_number' => $request->payment_number,
                'payment_date' => now(),
                'or_number' => Str::uuid(),
                'amount_paid' => $invoice->total->grand_price,
            ]);

            Db::commit();
        } catch (\Exception $e) {
            report($e);

            DB::rollBack(); // <= Rollback in case of an exception
        }

        return redirect()->route('payment.show', ['payment' => $createdPayment->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::latest()->first();
        $payments = Payment::orderBy('id', 'desc')->get();
        $payment = Payment::find($id);
        $paymentLatest = Payment::latest()->first();

        $discount = 0;
        $total = $invoice->items->sum('subtotal');

        if ($invoice->total) {
            $discount = $total * $invoice->total->discount / 100;
        }

        $discountedPrice = $total - $discount;

        return view('payment.payment-show', compact('invoice', 'payments', 'payment', 'discountedPrice', 'paymentLatest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
