<?php

namespace App\Libraries\Logistics3P;


class Grns {
	public function isDeletable($grn)
	{
		$response = ['status' => false, 'messages' => []];
		
		if($grn->stocks->count())
		{
			$hasChildren = FALSE;
			
			foreach($grn->stocks as $stock) {
				if($stock->children->count()) {
					$hasChildren = TRUE;
					break;
				}
			}
			
			if(!$hasChildren) {
				$message = 'Have stock records that are not reversible (ex: stocks are already issued, transferred, etc.';
				
				$response['status'] = TRUE;
				array_push($response['messages'], $message);
			}
		}
		
		return $response;
	}
}
