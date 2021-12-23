<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Finance\Account;
use App\Models\Finance\Transaction;
use App\Models\Vendor\Vendor;

class BillsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$pageData = array(
				'actions' => [
						'Create bill' => ['href' => '/finances/bills/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Bills' => '/finances/bills'],
				'title' => "Bills",
				'titlePage' => "Bills",
		);

		$bills = Transaction::bills()->get();
		
		return view('finances.bills.index', compact('bills', 'pageData'));
	}
	
	
	public function show(Request $request) {
		$bill = Transaction::findOrFail($request->bill);

		$pageData = array(
				'actions' => [
						'Create bill' => ['href' => '/finances/bills/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Bills' => '/finances/bills', 'Bill: ' . $bill->name => '/finances/bills/bill/'. $bill->_id],
				'title' => "Bill profile",
				'titlePage' => "Bill profile",
		);

		return view('finances.bills.show', compact('bill', 'pageData'));
	}
	
	
	public function create() {
		$pageData = array(
				'actions' => [
						'Create bill' => ['href' => '/finances/bills/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Bills' => '/finances/bills', 'Create a bill' => '/finances/bills/create'],
				'title' => "Create a bill",
				'titlePage' => "Create a bill",
		);

		$accounts = Account::get();
		$vendors = Vendor::get();
		
		return view('finances.bills.create', compact('accounts', 'vendors', 'pageData'));
	}
}
