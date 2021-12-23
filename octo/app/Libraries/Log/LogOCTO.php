<?php

namespace App\Libraries\Log;

use Carbon\Carbon;

use App\Models\Log\Temp;

class LogOCTO {
	public function request($request)
    {
        $response = Temp::create([
            'parameters' => $request->all(),
            'method' => $request->method(),
            'url' => $request->fullUrl()
        ]);

        return $response;
    }
}
