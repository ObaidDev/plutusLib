<?php

namespace Fdvice\realms\realm ;

interface RealmInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public  function addRealm($data , $credentials):array;
    // public  function getSubaccount($dataQuery , $credentials):array;
    // public  function deleteSubaccount($dataQuery , $credentials):array;
    // public  function updateSubaccount($dataQuery , $selector , $credentials):array;

    // public function createToken($in_data ,$subaccountId , $credentials):array;

}