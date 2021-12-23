<?php

namespace App\Http\Controllers\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Purchasing\Requisition;

class RequisitionsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	
	public function index() {
		$requisitions = Requisition::get();

		return view('purchasing.requisitions.index', compact('requisitions'));
	}
	
	
	public function create() {
		return view('purchasing.requisitions.create');
	}
	
	
	public function show(Request $request) {
		$requisition = Requisition::findOrFail($request->requisition);
		
		return view('purchasing.requisitions.show', compact('requisition'));
	}
	
	
	public function edit(Request $request) {
		$requisition = Requisition::findOrFail($request->requisition);
		
		return view('purchasing.requisitions.edit', compact('requisition'));
	}
}
