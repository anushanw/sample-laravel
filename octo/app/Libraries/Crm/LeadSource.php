<?php

namespace App\Libraries\Crm;

use Auth;

use App\Models\Crm\CustomerLeadSource;

class LeadSource {
	
	public function sourceById($id) {
		$source = CustomerLeadSource::find($id);
		
		return $source;
	}

	public function sources() {
		$sources = CustomerLeadSource::get();

		return $sources;
	}
	
	
	public function update($request) {
		$leadSourceID = isset($request->pk) ? $request->pk : $request->id;
		
		$leadSource = CustomerLeadSource::findOrFail($leadSourceID);
		
		$fillables = ['source'];
		foreach ($request->only($fillables) as $key => $value) {
			$leadSource->{$key} = !empty($value) ? $value : $leadSource->{$key};
		}
		$leadSource->statusID = !empty($request->statusID) ? (int)$request->statusID : $leadSource->statusID;
		$leadSource->save();
		
		return $leadSource;
	}
}
