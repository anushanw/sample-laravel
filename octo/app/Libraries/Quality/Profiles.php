<?php

namespace App\Libraries\Quality;

use App\Models\Quality\Profile;
use App\Models\Quality\ProfileItem;

class Profiles {
	public function controls() {
		$items = Profile::get();
		
		return $items;
	}
	
	public function items($profileID) {
		$items = ProfileItem::where('profileID', $profileID)->get();
		
		return $items;
	}
	
	public function models()
	{
		$data = array(
				['id' => 'Assurance', 'name' => 'Quality Assurance'],
				['id' => 'Control', 'name' => 'Quality Control'],
		);
		
		return $data;
	}
    
    public function vueForm($profileID, $edit = FALSE, $data = NULL) {
        $response = '';
        
        $fields = $this->items($profileID);
        
        foreach ($fields as $field) {
            $response .= $field->code . ": '";
            $response .= $edit ? (!empty($data->{$field->code}) ? $data->{$field->code} : NULL) : (!empty($field->defaultvalue) ? $field->defaultvalue : NULL);
            $response .= "', ";
        }
        
        return $response;
    }
}
