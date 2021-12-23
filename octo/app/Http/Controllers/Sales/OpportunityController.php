<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;

use App\Models\Category\Category;
use App\Models\Sales\Opportunity;

class OpportunityController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$opportunities = Opportunity::with(['customer', 'status'])->get();
		
		return view('sales.opportunities.index', compact('opportunities'));
	}
	
	
	public function show(Request $request) {
		$opportunity = Opportunity::findOrFail($request->opportunity);
		
		$pageData = array(
				"statusUpdate" => ["type" => 21],
				'actions' => [
						'Create opportunity' => ['href' => '/sales/opportunities/create', 'classes' => 'fa fa-plus'],
						'Attach a file' => ['href' => '/files/upload/?type=21&typeID=' . $opportunity->_id, 'classes' => 'fa fa-paperclip']
				],
				'breadcrumbs' => ['Sales' => '#', 'Opportunities' => '/sales/opportunities', 'Opportunity' => '/sales/opportunities/{$opportunity->id}'],
				'title' => "Opportunity - {$opportunity->name}",
				'titlePage' => "Opportunity: {$opportunity->name}",
		);
		
		return view('sales.opportunities.show', compact('pageData', 'opportunity'));
	}
	
	
	public function create() {
		$customerID = !empty($_GET['customerID']) ? $_GET['customerID'] : NULL;

		$createRoute = !empty($customerID) ? "?customerID=" . $customerID : NULL;
		
		$pageData = array(
				'actions' => ['Create opportunity' => ['href' => '/sales/opportunities/create' . $createRoute, 'classes' => 'fa fa-plus']],
				'breadcrumbs' => ['Sales' => '#', 'Opportunities' => '/sales/opportunities', 'Create opportunity' => '/sales/opportunities/create'],
				'title' => 'Create opportunity',
				'titlePage' => 'Create opportunity',
		);
		
		return view('sales.opportunities.create', compact('pageData', 'customerID'));
	}
}
