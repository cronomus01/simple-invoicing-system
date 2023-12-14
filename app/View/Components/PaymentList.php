<?php

namespace App\View\Components;

use App\Models\Payment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PaymentList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Collection $payments, public Payment $latest)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payment-list');
    }
}
