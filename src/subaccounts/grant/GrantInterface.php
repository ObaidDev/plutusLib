<?php

namespace Fdvice\subaccounts\grant ;

use Fdvice\subaccounts\subaccount\SubaccountDto ;


interface GrantInterface 
{
    public function addGrante(GrantDto $grantDto , $userToken):array ;
    public function deleteGrant(GrantDto $grantDto , $userToken) : array ;
    public function grantToSubaccount(GrantDto $grantDto, SubaccountDto $subaccount, $userToken)  ;
    
}
