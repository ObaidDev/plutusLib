<?php 

namespace Fdvice\tokens ;

use Fdvice\tokens\token\TokenInterface;
use Fdvice\tokens\token\Token;
use Fdvice\tokens\token\TokenDto;

final class TokenFacade
{

    private static TokenInterface $token ;


    function __construct() {

        self::$token = new Token() ;
    }
    

    function createToken($tokens , $userToken) : array {
        $res = self::$token->
                            creatUserToken(
                                $tokens ,
                                $userToken
                                ) ;
        return $res ;
    }

    function updateToken(TokenDto $token ,$userToken) : array {
        $res = self::$token->updateToken($token ,$userToken) ;
        return $res ;
    }

    function deleteToken(TokenDto $token ,$userToken) : array {
        $res = self::$token->deleteToken($token ,$userToken) ;
        return $res ;
    }
}
