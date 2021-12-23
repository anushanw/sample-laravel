<?php

namespace App\Libraries\Assets;

use App\Models\Asset\Asset;

class Depreciations {
	public function models() {
		$models = [
				['id' => 'none', 'name' => 'No depreciation'],
				['id' => 'straightLine', 'name' => 'Straight-line'],
				['id' => 'doublingDecliningBalance', 'name' => 'Doubling declining balance (percentage)'],
		];
	
		return $models;
	}
}
