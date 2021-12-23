<?php

namespace App\Http\Controllers\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;
use DNS1D;

use App\Models\Finance\PurchaseOrder;
use App\Models\Finance\PurchaseOrderItem;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use App\Models\Store\Store;
use App\Models\Vendor\Vendor;

use Facades\App\Libraries\Finance\Taxes;

class OrdersController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}


	public function index() {
        $orders = PurchaseOrder::with(['status', 'vendor'])->select(['date','_id','customID','name','vendorTypeID','statusID','created_at'])->get();

		return view('purchasing.orders.index', compact('orders'));
	}


	public function show(Request $request) {
		$pageActions = array();

		$po = PurchaseOrder::findOrFail($request->order);

        array_push($pageActions, ['name' => 'Generate barcodes', 'href' => "/purchasing/orders/{$po->_id}/barcodes/create", 'classes' => 'fa fa-qrcode']);

		return view('purchasing.orders.show', compact('po','pageActions'));
	}

	public function create() {
		$nowdate = Carbon::now()->format('m/d/Y');
		$validtill = Carbon::now()->addDays(30)->format('m/d/Y');

		$products = Product::get();
		$stores = Store::get();
		$vendors = Vendor::get();

		$taxes = Taxes::taxFieldsArray();

		return view('purchasing.orders.create', compact('taxes','nowdate', 'products', 'stores', 'validtill', 'vendors'));
	}

	public function print(Request $request) {
		$po = PurchaseOrder::findOrFail($request->order);

		$weighSlips = $po->weighSlips;

		$stocks = Stock::with(['product'])->where('poID', $po->id)->get();

		return view('purchasing.orders.print', compact('po'));
	}

	public function createBarcodes(Request $request)
    {
        $po = PurchaseOrder::with(['items'])->findOrFail($request->order);

        return view('purchasing.orders.create.barcodes', compact('po'));
    }
}
