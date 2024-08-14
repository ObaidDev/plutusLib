<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\subaccounts\subaccount\SubaccountDto ;
use Fdvice\subaccounts\subaccount\SubaccountInterface ;
use Fdvice\subaccounts\grant\GrantDto ;
use Fdvice\subaccounts\FacadSubaccount ;




$facadSubaccount = new FacadSubaccount() ;

// $subaccount = SubaccountDto::loginEmailPasswd("eyJpdiI6IjNBdnNPSy9sWk1jUlM4ZHA4dmtEWGc9PSIsInZhbHVlIjoiSzZVUW5TNHNiTHJ1bVM3dWtxNk5XT2FvWWttUFdFUlRPR2p4VWNpWm1OMD0iLCJtYWMiOiIyOTk5N2JmY2E0NDEzMDFhMjkxMWNmNDk0MDI4YWI5OWY1ZWI2ZDdmNDVlYjFiOTUxNWU1NjRkNTY1Y2Y3YmEzIiwidGFnIjoiIn0=" , "ppuzx5e2lci5phdtr9fsah857pk3fyvm@flespi.io") ;
// $response = $facadSubaccount->loginEmailPasswd($subaccount) ;

// var_dump($response);


/**
 * 
 * @@ test grant to subaccount method 
 * @@ (new method to link between grants and subaccounts)
 */

$grant = GrantDto::emptyConstruct() ;
$subaccount = SubaccountDto::emptyConstruct() ;
$userToken = "FlespiToken MwCZAAemFm4y8i5hHlRnuR1TypJigyqeCrr536GNT3D6LR5fVmeeygXKdwoEgf29" ;

$grant->setIds([4529]) ;
$subaccount->setIds([1928780]) ;


$response = $facadSubaccount->grantToSubaccount($grant , $subaccount , $userToken) ;

var_dump($response) ;
die() ;