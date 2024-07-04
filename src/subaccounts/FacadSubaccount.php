<?php

namespace Fdvice\subaccounts ;

use Fdvice\subaccounts\subaccount\SubaccountInterface;
use Fdvice\subaccounts\subaccount\Subaccount;
use Fdvice\subaccounts\subaccount\SubaccountDto ;


use Fdvice\tokens\token\TokenInterface;
use Fdvice\tokens\token\Token;
use Fdvice\tokens\token\TokenDto;

use Fdvice\auth\passwd\PasswdInterface;
use Fdvice\auth\passwd\Passwd;
use Fdvice\auth\passwd\PasswdDto;

use Fdvice\realms\realm\Realm;
use Fdvice\realms\realm\RealmDto;
use Fdvice\realms\realm\RealmInterface;

use Fdvice\exception\AccountCreationException ;
use Fdvice\exception\TokenCreationException ;

use Fdvice\subaccounts\limit\LimitInterface;
use Fdvice\subaccounts\limit\Limit;
use Fdvice\subaccounts\limit\LimitDto;

use Fdvice\calculate\manage\CalculatorInterface ;
use Fdvice\calculate\manage\Calculator ;


use Fdvice\subaccounts\grant\GrantInterface ;
use Fdvice\subaccounts\grant\Grant ;
use Fdvice\subaccounts\grant\GrantDto ;







// take the token form the config just for dev purpose .
// require_once base_path()."/config/config-flespi.php" ;
// require_once "./config/config-exemple.php" ;

final class FacadSubaccount
{

    private static SubaccountInterface $subaccount ;
    private static TokenInterface $token ;
    private static PasswdInterface $passwd ;
    private static RealmInterface $realm ;
    private static LimitInterface $limit ;
    private static CalculatorInterface $caluctor ;
    private static GrantInterface $grant ;


    public function __construct()
    {
        self::$subaccount = new Subaccount ();
        self::$token = new Token() ;
        self::$passwd = new Passwd() ;
        self::$realm = new Realm() ;
        self::$limit = new Limit() ;
        self::$caluctor = new Calculator();
        self::$grant = new Grant() ;

    }

    public function getterSubaccount(){
        return self::$subaccount ;
    }

    public function setterSubaccount($subaccount){
        self::$subaccount = $subaccount;
    }






    //todo use Subaccount object . 
    public  function addReseller($subaccount , $userToken):array{

        $res = array() ;
        $subaccountToken = new TokenDto(1) ;
        $subaccountToken->setInfo($subaccount->getName()."-Token") ;
        $subaccountToken->setTtl(31536000) ;

        //? add Reseller as subaccount
        {
            $subaccountResp = self::$subaccount->addSubaccount([$subaccount()] ,
            $userToken) ;
            if (array_key_exists('errors', $subaccountResp)) {
                throw (new AccountCreationException($subaccountResp["errors"][0]["reason"])) ;
            }
            $subaccountId = $subaccountResp["result"][0]["id"] ;

        }

        // ? create Token for the Reseller
        {
            $token = self::$token->addSubaccountToken([$subaccountToken] ,
                $subaccountId , $userToken
            );

            if (array_key_exists('errors', $token)) {
                // return $token ;
                $del = self::$subaccount->deleteSubaccount([$subaccountId]
                , $userToken) ;
    
                // var_dump($token["errors"][0]) ;
                
                throw (new TokenCreationException(
                    $token["errors"][0]["reason"]
                    
                )) ;
                
            }
        }


        //?update the passwd 
        {
            $passwdDto = new PasswdDto($subaccount->getPasswd()) ;
            $key = "FlespiToken ".$token["result"][0]["key"] ;
            $res = self::$passwd->updatePasswd($passwdDto, $key);

        }

        // //? create a realm for this Reseller 
        // {
        //     $tokenDto = new TokenDto(1) ;
        //     $realmDto = new RealmDto(
        //         $subaccount->getName()."-Realm" ,
        //         2,
        //         $tokenDto
        //     );
        //     $realmResult = self::$realm->addRealm([$realmDto] , $key) ;

        // }

        //! create the 0device limit . 
        {
            $limit1 = LimitDto::create(0) ;
            $limitRes = self::$limit->addLimit([$limit1] , $key) ;
        }


        //!create reportes . 
        {
            $jsonString = file_get_contents(__DIR__."/../../config/calculators.json");
            $reportesRes = self::$caluctor->addCalculators(json_decode($jsonString, true) , $key) ;
        }
        // { 
            // var_dump($subaccountId) ;

            //! $token = self::$subaccount->createToken($token_data , 
            //! $subaccountId , $GLOBALS["Token"]
            //!! ) ;
            //! $tokenDto = new TokenDto(0) ;
        // }


        // var_dump("toke_error" . array_key_exists('errors', $token)) ;
        //? $res["realm"] = $realmResult["result"][0] ;


        $res["subaccount"] = $subaccountResp["result"][0] ;
        $res["token"] = $token["result"][0] ;
        $res["limit"] = $limitRes["result"][0] ;
        $res["reporte"] = $reportesRes["result"] ;


        // var_dump("passwd is :" . $subaccount->getPasswd()) ;
        return $res ;
    }

    public  function addCompany($subaccount , $userToken):array{

        $res = array() ;
        // $subaccountId=null ;
        // $key=null ;
        //? CREATE THE SUBACCOUNT 
        {
            $subaccountResp = self::$subaccount->addSubaccount([$subaccount()] ,
            $userToken) ;
            // ! return a error if the user not created succfuly .
            if (array_key_exists('errors', $subaccountResp)) {
                throw (new AccountCreationException($subaccountResp["errors"][0]["reason"])) ;
            }
            $subaccountId = $subaccountResp["result"][0]["id"] ;
        }


        //? CREATE THE TOKEN .
        { 
            // $tokenName = $subaccount->getName()."-Token";
            $subaccountToken = new TokenDto(1) ;
            // $tokenName."-Master"
            $subaccountToken->setInfo($subaccount->getName()."-Token"."-Company") ;

            $token = self::$token->addSubaccountToken([$subaccountToken] ,
                $subaccountId , $userToken
            );

            //! if we got somthing worring with token creation we roll back.
            if (array_key_exists('errors', $token)) {
                $del = self::$subaccount->deleteSubaccount([$subaccountId]
                , $userToken) ;
                
                throw (new TokenCreationException(
                    $token["errors"][0]["reason"]
                    
                )) ;
                
            }
        }

        //? change the password so we can use it
        {
            $passwdDto = new PasswdDto($subaccount->getPasswd()) ;
            $key = "FlespiToken ".$token["result"][0]["key"] ;
            self::$passwd->updatePasswd($passwdDto, $key);
        }

        // //? CREATE A REALM FOR COMPANY 
        // {
        //     $tokenDto = new TokenDto(0) ;
        //     $realmDto = new RealmDto(
        //         $subaccount->getName()."-Realm" ,
        //         0,
        //         $tokenDto
        //     );
        //     $realmResult = self::$realm->addRealm([$realmDto] , $key) ;

            
        //     // var_dump($realmResult) ;

        // }

        $res["subaccount"] = $subaccountResp["result"][0] ;
        // $res["realm"] = $realmResult["result"][0] ;
        $res["token"] = $token["result"][0] ;

        return $res ;
    }

    public  function getSubaccount($dataQuery , $userToken):array{
        $res = self::$subaccount->getSubaccount($dataQuery , $userToken) ;
        return $res ;
    }

    public  function deleteSubaccount($selector , $userToken):array{
        $res = self::$subaccount->deleteSubaccount($selector , $userToken) ;
        // $res = self::$subaccount->deleteSubaccount($selector , $GLOBALS["Token"]) ;
        
        return $res ;

    }

    public  function updateSubaccount($in_data , $selector , $userToken):array{
        $res = self::$subaccount->updateSubaccount($in_data , $selector , $userToken) ;
        return $res ;
    }


    public function loginEmailPasswd(SubaccountDto $subaccount) : array {
        $res = self::$subaccount->loginEmailPasswd($subaccount) ;
        return $res ;
    }

    function addLimit($limit , $userToken) : array {
        
        $res = self::$limit->addLimit($limit , $userToken) ;
        return $res ;
    }


    function addGrante(GrantDto $grantDto , $userToken) : array
    {
        $res = self::$grant->addGrante($grantDto , $userToken) ;
        return $res ;
        
    }

    function deleteGrant(GrantDto $grantDto , $userToken) : array {
        $res = self::$grant->deleteGrant($grantDto , $userToken) ;
        return $res ;
    }


    
}
