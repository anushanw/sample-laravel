<?php

namespace App\Libraries\Assets;

use App\Models\Asset\Asset;

class Assets {
	public function assets() {
		$assets = Asset::get();
	
		return $assets;
	}
}
