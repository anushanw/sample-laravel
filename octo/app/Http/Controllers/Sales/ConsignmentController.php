<?php

namespace App\Http\Controllers\Sales;

use Facades\App\Libraries\System\CustomID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Crm\Customer;
use App\Models\Product\Product;
use App\Models\Sales\Consignment;


class ConsignmentController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$consignments = Consignment::get();
		
		$pageData = array(
				'actions' => [
						'Create consignment' => ['href' => '/sales/consignments/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Consignments' => '/sales/consignments'],
				'title' => 'Consignments',
				'titlePage' => 'Consignments',
		);
		
		return view('sales.consignments.index', compact('pageData', 'consignments'));
	}
	
	
	public function show(Request $request) {
		$consignment = Consignment::find($request->consignment);
		
		$pageData = array(
				'actions' => [
						'Create consignment' => ['href' => '/sales/consignments/create', 'classes' => 'fa fa-plus'],
						'Return items' => ['href' => "/sales/consignments/return/?consignmentID={$consignment->id}", 'classes' => 'fa fa-cart-arrow-down']
				],
				'breadcrumbs' => ['Sales' => '#', 'Consignments' => '/sales/consignments'],
				"title" => "Consignment:",
				"titlePage" => "Consignments",
		);
		
		return view('sales.consignments.show', compact('pageData', 'consignment'));
	}
	
	
	public function create() {
		$pageData = array(
				'actions' => [
						'Create consignment' => ['href' => '/sales/consignments/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Consignments' => '/sales/consignments', "Create" => "/sales/consignments/create"],
				'title' => 'Create consignments',
				'titlePage' => 'Create consignments',
		);
		
		$customers = Customer::get();
		$models = [
				['id' => 'simple', 'name' => 'Simple'],
				['id' => 'weight', 'name' => 'Weight'],
				['id' => 'weightAndPieces', 'name' => 'Weight and Pieces']
		];
		$products = Product::get();
		
		return view('sales.consignments.create', compact('pageData', 'customers', 'models', 'products'));
	}
	
	
	public function createReturn(Request $request) {
		$pageData = array(
				'actions' => [
						'Create consignment' => ['href' => '/sales/consignments/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Consignments' => '/sales/consignments', "Return" => "/sales/consignments/return"],
				'title' => 'Create consignments item return',
				'titlePage' => 'Create consignments item return',
		);
		
		$consignment = !empty($request->consignmentID) && !empty($consignmentRecord = Consignment::find($request->consignmentID)) ? $consignmentRecord : NULL;
		
		$products = array();
		$showPieces = false;
		foreach ($consignment->items as $item) {
			$row['id'] = $item->id;
			$row['productID'] = $item->productID;
			$row['productName'] = $item->productName;
			$row['memo'] = $item->memo;
			$row['qty'] = $item->qty;
			$row['qtyReturn'] = 0;
			$row['qtySub'] = $item->qtySub;
			$row['qtySubReturn'] = 0;
			
			$showPieces = $showPieces || (!empty($item->qtySub) && $item->qtySub >= 0) ? TRUE : FALSE;
			array_push($products, $row);
		}
		
		return view('sales.consignments.return', compact('pageData', 'consignment', 'products', 'showPieces'));
	}
}
