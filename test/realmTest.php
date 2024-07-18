<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\realms\FacadeRealm ;
use Fdvice\realms\realm\RealmDto;
use Fdvice\realms\user\UserDto ;
use Fdvice\tokens\token\TokenDto ;

$facadeRealm = new FacadeRealm() ;

    //! companies creation tests
    // {
    //     $acl = [
    //         [
    //             "uri" => "mqtt",
    //             "actions" => [
    //                 "subscribe"
    //             ]
    //         ],
    //         [
    //             "uri" => "gw/devices",
    //             "methods" => [
    //                 "GET",
    //                 "POST",
    //                 "PUT",
    //                 "DELETE"
    //             ]
    //         ],
    //         [
    //             "uri" => "gw/geofences",
    //             "methods" => [
    //                 "GET",
    //                 "PUT",
    //                 "DELETE",
    //                 "POST"
    //             ]
    //         ]
    //     ];
    //     $company01 = UserDto::create(
    //         "Ressler01",
    //         "$2y$10$qPp33z6Jk2sO9MG/X96lsu5JJR.FANeYlR34FpXYI9j6EisAV9nZi",
    //         22411
    //     );


    
    //     //? make a token first :

    //     $tokenDto = new TokenDto(0) ;
    //     // $tokenDto->setAcl($acl) ;

    //     $company01->setToken($tokenDto);

    //     //     $company02 = UserDto::create(
    //     //         "company02",
    //     //         "12345U984U9UHIHKJHKJSHIUHIsfqsfZ",
    //     //         18175

        // );
        // $masterAdmin ="FlespiToken AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW" ;
        // $response = $facadeRealm->addUserRealm($company01 , $masterAdmin);
        //     // $users = [$user1] ;
        // echo("CREATE user --------------\n");
        // var_dump($response);
        // }

        // echo("LOGIN user --------------\n");
        // // $realmDto = RealmDto::emptyConstruct();
        // // $realmDto->setIds([22411]) ;
        // // $public_key = $facadeRealm->getRealm($realmDto ,$masterAdmin)["result"][0]["public_id"] ;
        // {
        //     $user = UserDto::login("jyvyjuno" , "3dfe3df5a4febffe4d3393c6fce5946521acbd67fd4af01678abeccd6d58f5bf1366b1fcca5dd2c75abc001ad01e7c853e1d5e68a1521974dcb0740800fee1b0" , "fX9aWCFycvs") ;
        //     $res = $facadeRealm->login($user) ;


        //     var_dump($res) ;
        // }

    
    
    
    // }

    $realm1 = new RealmDto("admins1" ,2  ,
    new TokenDto(0));

    $response = $facadeRealm->addRealm([$realm1] , "FlespiToken AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW");

    var_dump($response) ;