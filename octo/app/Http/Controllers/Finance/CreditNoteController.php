<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Transaction;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('subscriptionCheck');
    }


    public function index() {
        $credit_notes = Transaction::with(['customer', 'items', 'invoicePayments', 'status'])->creditNotes()->get();

        return view('finances.credit-notes.index', compact('credit_notes', ));
    }


    public function show(Request $request) {
        $creditnote = Transaction::with(['items'])->findOrFail($request->credit_note);

        return view('finances.credit-notes.show', compact('creditnote'));
    }


    public function create(Request $request)
    {
        $products = Product::notBelogsToCustomer()->get();

        return view('finances.credit-notes.create', compact('request', 'products'));
    }


    public function print(Request $request)
    {
        $creditnote = Transaction::with(['items'])->findOrFail($request->creditnote);

        return view('finances.credit-notes.print', compact('creditnote'));
    }
}
