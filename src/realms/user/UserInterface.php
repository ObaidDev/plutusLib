<?php

namespace Fdvice\realms\user ;

interface UserInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public  function realmCreateUser(UserDto $user , $credentials):array;
    public  function realmDeleteUser(UserDto $user , $credentials):array;
    public  function login($user):array;
    // public  function deleteSubaccount($dataQuery , $credentials):array;
    // public  function updateSubaccount($dataQuery , $selector , $credentials):array;

    // public function createToken($in_data ,$subaccountId , $credentials):array;

}