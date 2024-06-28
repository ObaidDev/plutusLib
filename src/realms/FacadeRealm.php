<?php

namespace Fdvice\realms ;
use Fdvice\realms\realm\RealmInterface;
use Fdvice\realms\realm\Realm;

use Fdvice\realms\user\UserInterface;
use Fdvice\realms\user\User;
use Fdvice\realms\user\UserDto;

use Fdvice\exception\AccountCreationException ;

// use Fdvice\exception\AccountCreationException ;
// use Fdvice\exception\TokenCreationException ;

// take the token form the config just for dev purpose .
// require_once base_path()."/config/config-flespi.php" ;
require_once "./config/config-exemple.php" ;

final class FacadeRealm
{

    private static RealmInterface $realm ;
    private static UserInterface $user ;

    public function __construct()
    {
        self::$realm = new Realm ();
        self::$user = new User ();
    }

    public function getterRealm(){
        return self::$realm ;
    }

    public function setterRealm($realm){
        self::$realm = $realm;
    }






    //todo use Subaccount object . 
    public  function addRealm($realms , $userToken):array{

        $res = self::$realm->addRealm($realms ,$GLOBALS["Token"]) ;
        return $res ;
    }

    public  function addCompany($users , $userToken):array{
        $global_resp=array() ;

        //! add companies as realm users . 
        {
            foreach ($users as $user) {
                $res = self::$user->realmCreateUser($user() ,$user->getRealmId(),$userToken) ;
                
                if (array_key_exists('errors', $res)) {
                    throw (new AccountCreationException($res["errors"][0]["reason"])) ;
                }
                array_push($global_resp , $res["result"][0]) ;
                // array_push($global_resp , $res["result"]) ;
    
            }
        }

        //! updated thos companies to add to them the 0 device limit . 
        {
            
        }
        return $global_resp ;
    }


    public function login(UserDto $user) : array {
        $res = self::$user->login($user) ;

        return $res ;
    }

   


    
}
