<?php

namespace Fdvice\subaccounts\subaccount ;

interface SubaccountInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public  function addSubaccount($data , $credentials):array;
    public  function getSubaccount($dataQuery , $credentials):array;
    public  function deleteSubaccount(SubaccountDto $dataQuery , $credentials):array;
    public  function updateSubaccount($dataQuery , $selector , $credentials):array;

    public function createToken($in_data ,$subaccountId , $credentials):array;
    public function loginEmailPasswd(SubaccountDto $subaccount):array;

    // change the passwd .
    // public function changePasswd($passwd , $credentials) ;
}