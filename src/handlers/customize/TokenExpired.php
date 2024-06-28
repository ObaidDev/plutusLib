<?php

namespace Fdvice\handlers\customize ;
use Fdvice\handlers\base\BaseHandler ;


class TokenExpired extends BaseHandler {



    public function handle($request){   
        if ($request == "tokenEx") {
            var_dump("u shoud login first");
        }

        else {
            parent::handle($request) ;
        } ;
    }
}
