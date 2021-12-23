<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Models\Crm\Customer;
use App\Models\Finance\Account;
use App\Models\Sales\Order as SalesOrder;
use App\Models\Finance\Transaction;
use App\Models\Product\Product;
use App\Models\Sales\Quotation;
use App\Models\Stock\Stock;

class InvoiceController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$invoices = Transaction::with(['customer', 'items', 'invoicePayments', 'status'])->invoices()->get();
		
		$pageData = array(
				'actions' => [
						"Create invoice" => ['href' => "/finances/invoices/create", 'classes' => 'fa fa-plus'],
				],
				'breadcrumbs' => ['Finances' => '#', 'Invoices' => '/finances/invoices'],
				'title' => 'Invoices',
				'titlePage' => 'Invoices',
		);
		
		return view('finances.invoices.index', compact('invoices', 'pageData'));
	}
	
	
	public function show(Request $request) {
		$invoice = Transaction::with(['items', 'items.product'])->findOrFail($request->invoice);
		
		$pageData = array(
				'actions' => [
						"Create invoice" => ['href' => "/finances/invoices/create", 'classes' => 'fa fa-plus'],
						"Receive payment" => ['href' => "/finances/invoices/payment/create?invoiceID={$invoice->id}", 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Invoices' => '/finances/invoices', 'Invoice' => "/finances/invoices/{$invoice->id}"],
				'title' => 'Invoice',
				'titlePage' => 'Invoice',
		);
		
		return view('finances.invoices.show', compact('pageData', 'invoice'));
	}
	
	
	public function create(Request $request)
	{
		return view('finances.invoices.create', compact('request'));
	}
	
	
	public function createPayment(Request $request) {
		$invoice = Transaction::find($request->invoiceID);
		
		$paymentMethods = Account::where('subType', 6)->get();
		
		
		$pageData = array(
				'actions' => [
						'Create invoice payment' => ['href' => '/finances/invoices/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Invoices' => '/finances/invoices', 'Create payment' => '#'],
				'title' => 'Invoice payment create',
				'titlePage' => 'Create new invoice payment',
		);
		
		return view('finances.invoices.payments.create', compact('pageData', 'invoice', 'paymentMethods'));
	}
}
