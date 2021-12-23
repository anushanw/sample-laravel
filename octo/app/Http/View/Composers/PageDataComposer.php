<?php

namespace App\Http\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

use Auth;

use App\Models\System\Page;

class PageDataComposer {
	public function __construct(Request $request) {
		$this->request = $request;
	}

	public function compose(View $view)
	{
		$route = $this->request->route();

//		dd($route->getName());

		if($route) {
            if($route->getName()) {
                $page = Page::with('actions')->where('name', $route->getName())->firstOrFail();
            } else {
                $page = Page::with('actions')->where('name', 'notfound')->firstOrFail();
            }
        } else {
		    $page = NULL;
        }

//		dd($route);

		$user = Auth::user();

		$view->with([
		    'page' => $page,
            'route' => $route,
            'user' => $user
        ]);
	}
}
