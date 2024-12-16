<?php

namespace Fdvice\handlers\customize ;
use Fdvice\handlers\base\BaseHandler ;
use Fdvice\exception\TokenExpiredException ;


class TokenExpired extends BaseHandler {



    public function handle($request){   
        if (isset($response['status']) && $response['status'] == 400) {
            if (isset($response['errors']) && is_array($response['errors'])) {
                foreach ($response['errors'] as $error) {
                    if (isset($error['code']) && $error['code'] == 1004) {

                        throw new TokenExpiredException($error['reason']);
                        return;
                    }
                }
            }
        }

        else {
            parent::handle($request) ;
        } ;
    }
}
