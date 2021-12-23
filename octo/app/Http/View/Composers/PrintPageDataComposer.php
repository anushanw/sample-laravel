<?php

namespace App\Http\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

use Auth;

use App\Models\System\Page;

use Facades\App\Libraries\System\Settings;

class PrintPageDataComposer {
	public function __construct(Request $request) {
		$this->request = $request;
	}
	
	public function compose(View $view)
	{
		if(Auth::check()) {
			$orgSettings = Settings::organization();
		} else {
			$orgSettings = [];
		}
		
		$view->with(['orgSettings' => $orgSettings]);
	}
}