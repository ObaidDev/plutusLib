<?php

namespace Fdvice\subaccounts\limit ; 


interface LimitInterface {
    public function addLimit(array $limits , $userToken) ;
}