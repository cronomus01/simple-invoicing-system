@extends('layout.base', ['invoices' => $invoices, 'invoice' => $invoice])

@section('content')
    <section class="mt-5 w-2/4 relative">
        <!--defines theme-->
        <h1 class="text-2xl uppercase mb-3">Invoicing System</h1>
        <!--writes independent content relating to that theme-->
        <article>
            <p class="text-lg">
                Invoicing software generates billing for services and products. It streamlines the process for getting paid,
                giving your business an accurate picture of its finances, ensuring liquidity and flexibility, and
                contributing to a healthy financial forecast.
            </p>
        </article>
    </section>
    <figure class="absolute bottom-0 right-0 w-[35%]">
        <img src="{{ asset('assets/icons/undraw_on_the_office_re_cxds.svg') }}" alt="man looking on a series of process">
    </figure>
@endsection
