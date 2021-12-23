<?php

namespace App\Libraries\Communications;

use App\Models\Communication\Communication;

class Communications {
	public function types()
	{
		$types = array(
				1 => 'Calls',
				2 => 'Text/SMS',
				3 => 'Email notification (system)',
				4 => 'Email',
				5 => 'Instant messages',
				6 => 'Meeting',
				7 => 'Postal mail',
		);
		
		return $types;
	}
	
	public function selectOptionsTypes() {
		$response = $this->types();
		
		return $response;
}
}
