<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Crm\Customer;
use App\Models\Sales\Order as SalesOrder;
use App\Models\Finance\Transaction;
use App\Models\Product\Product;
use App\Models\Sales\Quotation;

class ReturnController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$salesReturns = Transaction::salesReturns()->get();
		
		$pageData = array(
				'actions' => [
						"Create sales return" => ['href' => "/sales/returns/create", 'classes' => 'fa fa-plus'],
				],
				'breadcrumbs' => ['Sales' => '#', 'Sales returns' => '/sales/returns'],
				'title' => 'Sales returns',
				'titlePage' => 'Sales returns',
		);
		
		return view('sales.returns.index', compact('salesReturns', 'pageData'));
	}
	
	
	public function show(Request $request) {
		$invoice = Transaction::findOrFail($request->return);
		
		$pageData = array(
				'actions' => [
						"Create sales return" => ['href' => "/sales/returns/create", 'classes' => 'fa fa-plus'],
						"Receive payment" => ['href' => "/sales/returns/payment/create?invoiceID={$invoice->id}", 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Sales returns' => '/sales/returns', 'Sales return' => "/sales/returns/invoice/{$invoice->id}"],
				'title' => 'Sales return',
				'titlePage' => 'Sales return',
		);
		
		return view('sales.returns.show', compact('pageData', 'invoice'));
	}
	
	
	public function create() {
		$pageData = array(
				'actions' => [
						'Create sales return' => ['href' => '/sales/returns/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Sales returns' => '/sales/returns', 'Create sales return' => '/sales/returns/create'],
				'title' => 'Sales return create',
				'titlePage' => 'Create new sales return',
		);
		
		$customers = Customer::get();
		$models = [
				['id' => 'simple', 'name' => 'Simple'],
				['id' => 'weight', 'name' => 'Weight'],
				['id' => 'weightAndPieces', 'name' => 'Weight and Pieces']
		];
		$products = Product::get();
		$quotations = Quotation::get();
		$salesOrders = SalesOrder::get();
		
		return view('sales.returns.create', compact('pageData', 'customers', 'models', 'products', 'quotations', 'salesOrders'));
	}
}
