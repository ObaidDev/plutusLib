<?php

namespace Fdvice\auth ;

use Fdvice\auth\passwd\PasswdInterface;
use Fdvice\auth\passwd\Passwd;


require_once base_path()."/config/config-flespi.php" ;




final class FacadeAuth
{

    private static PasswdInterface $passwd;

    function __construct (){
        self::$passwd = new Passwd();
    }

    function updatePasswd($passwd , $userToken){
        $res = self::$passwd->updatePasswd() ;
        return $res ;
    }


}