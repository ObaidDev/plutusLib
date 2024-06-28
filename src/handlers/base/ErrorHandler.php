<?php

namespace Fdvice\handlers\base ;

use Fdvice\exception\TokenCreationException;
use Fdvice\exception\TokenExperedException;



class ErrorHandler extends BaseHandler {



    public function handle($request){   
        if ($request == 1) {
            var_dump("sir tl3b" );
        }
    }
}
