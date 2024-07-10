<?php

namespace Fdvice\handlers\customize ;

use Fdvice\exception\ItemCreationExecption;
use Fdvice\exception\TokenExpiredException;
use Fdvice\exception\ItemNotFoundException ;
use Fdvice\handlers\base\BaseHandler;

final class ErrorMiddleware extends BaseHandler
{
    public function handle($request){   
        // var_dump($request) ;
        if (is_array($request) && array_key_exists('errors', $request)) {
            $code = $request["errors"][0]["code"] ;

            switch ($code) {
                case 2:
                    # code...
                    return throw new ItemCreationExecption($request["errors"][0]["reason"]) ;
                    break;
                    
                case 3:
                    # code...
                    return throw new ItemNotFoundException($request["errors"][0]["reason"]);
                    break;
                
                case 4:
                    # code...
                    return throw new TokenExpiredException($request["errors"][0]["reason"]);
                    break;



                
                // default:
                //     # code...
                //     return throw new \Exception($request["errors"][0]["reason"]) ;
                //     break;
            }
            
        }
    }
}
