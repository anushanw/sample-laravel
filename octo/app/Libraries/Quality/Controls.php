<?php

namespace App\Libraries\Quality;

use App\Models\Quality\Control;

class controls {
    public function selectOptions()
    {
        $controls = Control::get();
        
        return $controls;
    }
}
