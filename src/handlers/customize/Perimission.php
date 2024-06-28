<?php

namespace Fdvice\handlers\customize ;
use Fdvice\handlers\base\BaseHandler ;


class Perimission extends BaseHandler {



    public function handle($request){   
        if ($request == "pp") {
            var_dump("u don't have the perimission");
        }

        else {
            parent::handle($request) ;
        }
    }
}
