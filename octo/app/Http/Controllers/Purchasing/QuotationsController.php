<?php

namespace App\Http\Controllers\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Purchasing\Quotation;

use Facades\App\Libraries\Finance\Taxes;

class QuotationsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$quotations = Quotation::get();
		
		return view('purchasing.quotations.index', compact('quotations'));
	}
	
	
	public function create() {
		$taxes = Taxes::taxFieldsArray();
		
		return view('purchasing.quotations.create', compact('taxes'));
	}
	
	
	public function show(Request $request) {
		$quotation = Quotation::findOrFail($request->quotation);
		
		return view('purchasing.quotations.show', compact('quotation'));
	}
	
	
	public function edit(Request $request) {
		$quotation = VendorQuotation::findOrFail($request->quotation);
		
		return view('purchasing.quotations.edit', compact('quotation'));
	}
}
