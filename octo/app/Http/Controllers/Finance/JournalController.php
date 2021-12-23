<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Finance\Account;
use App\Models\Finance\Transaction;

class JournalController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$pageData = array(
				'actions' => [
						'Create a journal entry' => ['href' => '/finances/journals/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Journal entries' => '/finances/journals'],
				'title' => "Journal entries",
				'titlePage' => "Journal entries",
		);

		$transactions = Transaction::get();
		
		return view('finances.journals.index', compact('transactions', 'pageData'));
	}
	
	
	public function show(Request $request) {
		$transaction = Transaction::find($request->journal);

		$pageData = array(
				'actions' => [
						'Create a journal entry' => ['href' => '/finances/journals/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Journal entries' => '/finances/journals', 'Transaction: ' . $transaction->name => '/finances/journals/journal/'. $transaction->_id],
				'title' => "Transaction profile",
				'titlePage' => "Transaction profile",
		);
		
		return view('finances.journals.show', compact('transaction', 'pageData'));
	}
	
	
	public function create() {
		$pageData = array(
				'actions' => [
						'Create a journal entry' => ['href' => '/finances/journals/create', 'classes' => 'fa fa-plus']
				],
				'breadcrumbs' => ['Finances' => '#', 'Journal entries' => '/finances/journals', 'Create a journal entry' => '/finances/journals/create'],
				'title' => "Create a journal entry",
				'titlePage' => "Create a journal entry",
		);

		$accounts = Account::get();
		
		return view('finances.journals.create', compact('accounts', 'pageData'));
	}
}
