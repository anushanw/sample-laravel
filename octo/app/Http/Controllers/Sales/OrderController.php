<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Product\Product;
use App\Models\Sales\Order;
use App\Models\System\Template;

class OrderController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$orders = Order::get();
		
		$pageData = array(
				'actions' => [
						'Create sales order' => ['href' => '/sales/orders/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Orders' => '/sales/orders'],
				'title' => 'Sales orders',
				'titlePage' => 'Sales orders',
		);
		
		return view('sales.orders.index', compact('pageData', 'orders'));
	}
	
	
	public function show(Request $request) {
		$order = Order::findOrFail($request->order);
		
		$pageData = array(
				"statusUpdate" => ["type" => 51],
				'actions' => [
						'Create sales order' => ['href' => '/sales/orders/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Orders' => '/sales/orders', "Order" => "/sales/orders/order/{$order->id}"],
				'title' => 'Sales order',
				'titlePage' => "Sales order",
		);
		
		if(!(!empty($order->invoiced) && $order->invoiced)) {
			$pageData['actions']['Convert to invoice'] = ['href' => '#', 'classes' => 'fa fa-arrow-right', 'vonClick' => 'convertToInvoice'];
		}
		
		return view('sales.orders.show', compact('pageData', 'order'));
	}
	
	
	public function create(Request $request) {
		$aoid = Auth::user()->currentTeam->id;

		$customerID = !empty($_GET['customerID']) ? $_GET['customerID'] : NULL;
		
		$templates = Template::where('oid', $aoid)->get();
		
		$products = Product::get();
		
		return view('sales.orders.create', compact('products', 'templates', 'customerID'));
	}
}
