
import { clickButton } from "./invoice/invoice-edit.js";

const print = document.getElementById('print');

function printInvoice() {
    window.print();
}

clickButton(print, 'print', printInvoice)
