<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;

use App\Models\Product\Product;
use App\Models\Sales\Quotation;
use App\Models\System\Template;

use Facades\App\Libraries\System\Addresses;

class QuotationsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$quotations = Quotation::get();
		
		$pageData = array(
				'actions' => [
						'Create quotation' => ['href' => '/sales/quotations/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Quotations' => '/sales/quotations'],
				'title' => 'Quotations',
				'titlePage' => 'Quotations',
		);
		
		return view('sales.quotations.index', compact('pageData', 'quotations'));
	}
	
	
	public function show(Request $request) {
		$quotation = Quotation::find($request->quotation);
		
		$address = !empty($quotation->customer->addresses['main']) ? $quotation->customer->addresses['main']: Addresses::empty();
		
		$pageData = array(
				'actions' => [
						'Create quotation' => ['href' => '/sales/quotations/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Quotations' => '/sales/quotations', 'Quotation profile' => "/sales/quotations/{$quotation->id}"],
				'title' => 'Quotation profile',
				'titlePage' => 'Quotation profile',
		);

		return view('sales.quotations.show', compact('pageData', 'quotation', 'address'));
	}
	
	
	public function create(Request $request) {
		$aoid = Auth::user()->currentTeam->id;

		$cid = !empty($request->cid) ? $request->cid : NULL;
		
		$templates = Template::where('oid', $aoid)->get();
		$products = Product::get();
		
		$pageData = array(
				'actions' => [
						'Create quotation' => ['href' => '/sales/quotations/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Quotations' => '/sales/quotations', 'Create quotation' => '/sales/quotations/create'],
				'title' => 'Create quotation',
				'titlePage' => 'Create quotation',
		);
		
		return view('sales.quotations.create', compact('pageData', 'products', 'templates', 'cid'));
	}
}
