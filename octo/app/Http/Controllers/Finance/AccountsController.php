<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Finance\Account;
use Facades\App\Libraries\System\Types;

class AccountsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$pageData = array(
				'actions' => [
						'Create account' => ['href' => '/finances/accounts/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Accounts' => '/finances/accounts'],
				'title' => "Chart of Accounts",
				'titlePage' => "Chart of Accounts",
		);

		$accounts = Account::get();
		
		return view('finances.accounts.index', compact('accounts', 'pageData'));
	}
	
	
	public function show(Request $request) {
		$account = Account::findOrFail($request->account);

		$pageData = array(
				'actions' => [
						'Create ledger account' => ['href' => '/finances/accounts/create', 'classes' => 'fa fa-plus'],
						'Edit ledger account' => ['href' => "/finances/accounts/{$account->_id}/edit", 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Accounts' => '/finances/accounts', "Account: {$account->name}" => "/finances/accounts/{$account->_id}"],
				'title' => "Account profile",
				'titlePage' => "Account profile",
		);
		
		return view('finances.accounts.show', compact('account', 'pageData'));
	}
	
	
	public function create() {
		$pageData = array(
				'actions' => [
						'Create ledger account' => ['href' => '/finances/accounts/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Accounts' => '/finances/accounts', 'Create ledger account' => '/finances/accounts/create'],
				'title' => "Create ledger account",
				'titlePage' => "Create ledger account",
		);

		$subTypes = Types::subTypesByType(47);
		$accounts = Account::get();
		
		return view('finances.accounts.create', compact('subTypes', 'accounts', 'pageData'));
	}
	
	
	public function edit(Request $request) {
		$account = Account::findOrFail($request->id);

		$pageData = array(
				'actions' => [
						'Create ledger account' => ['href' => '/finances/accounts/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Accounts' => '/finances/accounts', 'Account: ' . $account->name => "/finances/accounts/{$account->_id}", 'Edit ledger account' => "/finances/accounts/{$account->_id}/edit/"],
				'title' => "Edit ledger account",
				'titlePage' => "Edit ledger account",
		);

		$subTypes = Types::subTypesByType(47);
		$accounts = Account::get();

		return view('finances.accounts.edit', compact('account', 'subTypes', 'accounts', 'pageData'));
	}
}
