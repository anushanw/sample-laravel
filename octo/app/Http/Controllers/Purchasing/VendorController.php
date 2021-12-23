<?php

namespace App\Http\Controllers\Purchasing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Vendor\Vendor;

class VendorController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}


	/**     VENDORS LIST      **/
	public function index() {
		$vendors = Vendor::get();
		
		return view('purchasing.vendors.index', compact('vendors'));
	}


	/**     VENDOR PROFILE      **/
	public function show($id) {
		$vendor = Vendor::find($id);
		
		return view('purchasing.vendors.show', compact('vendor'));
	}


	/**     VENDOR CREATE PAGE      **/
	public function create() {
		return view('purchasing.vendors.create');
	}


	/**     VENDOR EDIT PAGE      **/
	public function edit($id) {
		$vendor = Vendor::find($id);
		
		return view ('purchasing.vendors.edit', compact('vendor'));
	}
}
