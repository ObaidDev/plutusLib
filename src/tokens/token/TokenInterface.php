<?php

namespace Fdvice\tokens\token ;

interface TokenInterface {

    public  function addSubaccountToken($in_data ,$subaccountId  , $credentials):array;
    public  function creatUserToken( $tokens ,$userToken):array;
    public  function updateToken(TokenDto $token ,$userToken):array;
    public function deleteToken (TokenDto $token ,$userToken):array ;


}