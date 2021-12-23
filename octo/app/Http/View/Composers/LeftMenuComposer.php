<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

use Auth;
use App\Models\System\Module;

class LeftMenuComposer {
	public function __construct() {
		//
	}
	
	public function compose(View $view) {
		$modules = Module::with('subModules')->orderBy('order')->get();
		
		$view->with('modules', $modules);
	}
}
