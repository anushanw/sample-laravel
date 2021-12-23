<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OverviewController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function overview() {
		$pageData = array(
				'actions' => [
						'Create sales order' => ['href' => '/sales/orders/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Sales' => '#', 'Overview' => '/sales/overview'],
				'title' => 'Sales overview',
				'titlePage' => 'Sales overview',
		);
		
		return view('sales.overview.overview', compact('pageData'));
	}
}
