<?php

namespace Fdvice\subaccounts\grant ;


interface GrantInterface 
{
    public function addGrante(GrantDto $grantDto , $userToken):array ;
    
}
