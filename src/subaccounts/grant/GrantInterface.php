<?php

namespace Fdvice\subaccounts\grant ;


interface GrantInterface 
{
    public function addGrante(GrantDto $grantDto , $userToken):array ;
    public function deleteGrant(GrantDto $grantDto , $userToken) : array ;
    
}
