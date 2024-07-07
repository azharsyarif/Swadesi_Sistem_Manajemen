<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Rekanan;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        $orders = Order::all();
        $rekanans = Rekanan::all();

        return view('Marketing.order.invoiceIndex', compact('invoices', 'orders', 'rekanans'));
    }
}
