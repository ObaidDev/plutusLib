<?php

namespace Fdvice\subaccounts\subaccount ;

interface SubaccountInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public  function addSubaccount($data , $credentials):array;
    public  function getSubaccount(SubaccountDto $subaccountDto , $credentials):array;
    public  function deleteSubaccount(SubaccountDto $dataQuery , $credentials):array;
    public  function updateSubaccount($dataQuery , $selector , $credentials):array;

    public function createToken($in_data ,$subaccountId , $credentials):array;
    public function loginEmailPasswd(SubaccountDto $subaccount):array;
    // loginPasswdLess
    public function loginPasswdLess(SubaccountDto $subaccount) :array;

    // public function createSubaccountTHRealm(SubaccountDto $subaccountDto , $credentials) : array ;


    // change the passwd .
    // public function changePasswd($passwd , $credentials) ;
}