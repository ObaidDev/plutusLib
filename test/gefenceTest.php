<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\geofence\FacadeGeofence ;
use Fdvice\geofence\manage\CircleDto;
use Fdvice\geofence\manage\GeofenceDto ;
use Fdvice\geofence\manage\PolygonDto ;
use Fdvice\geofence\manage\LineDto ;


##################################### // add Geofence ! ###################################
// make an object form FacadeGeofence

$facadeGrofence = new FacadeGeofence() ;
$userToken = "CaaFWLmqLlaXX4tM9B7C9LkGmEgE6EPAoY03SukImT0ksgNE5gBIjSmXcgM0sjhe" ;


// create a polygonDto
// {
//     $path = [
//     [
//         "lat"=> 32.75633101064877,
//         "lon"=> -8.37024908885448
//     ],
//     [
//         "lat"=> 33.02835310334567,
//         "lon"=> -7.8929728985284235
//     ],
//     [
//         "lat"=> 32.67598802923425,
//         "lon"=> -7.633374512516565
//     ],
//     [
//         "lat"=> 32.216085458694835,
//         "lon"=> -8.113089582570376
//     ]
//     ] ;
//     $polygonDto = PolygonDto::create("hello world" , $path) ;

//     $response = $facadeGrofence->addGeofence($polygonDto , $userToken) ;

//     var_dump($response) ;
//     die() ;
// }


// create Line !

// {

//     $path = [
//         [
//             "lat"=> 27.519128628380184,
//             "lon"=> -12.253247698271432
//         ],
//         [
//             "lat"=> 27.518493367969604,
//             "lon"=> -12.21626017547368
//         ],
//         [
//             "lat"=> 27.535555486124576,
//             "lon"=> -12.168497661973811
//         ],
//         [
//             "lat"=> 27.517044307736434,
//             "lon"=> -12.172406127356812
//         ],
//         [
//             "lat"=> 27.502426162841342,
//             "lon"=> -12.218098623928391
//         ]
//         ] ;
//         $lineDto = LineDto::create("Line Geofence" , $path) ;
    
//         $response = $facadeGrofence->addGeofence($lineDto , $userToken) ;
    
//         var_dump($response) ;
//         die() ;

// }


// delete :
// $geofenceDto = LineDto::emptyConstruct() ;
// $geofenceDto->setIds([1826,1847]) ;

// $response = $facadeGrofence->deleteGeofence($geofenceDto , $userToken) ;

// var_dump($response) ;
// die() ;


// ! update geofence !

// {
//     $path = [
//         [
//             "lat"=> 27.519128628380184,
//             "lon"=> -12.253247698271432
//         ],
//         [
//             "lat"=> 27.518493367969604,
//             "lon"=> -12.21626017547368
//         ],
//         [
//             "lat"=> 27.535555486124576,
//             "lon"=> -12.168497661973811
//         ]
//         ];
//     $lineDto = LineDto::emptyConstruct() ;
//     $lineDto->setIds([1878]) ;
//     // $lineDto->setPath($path) ;
//     // $lineDto->setName("chon gha-yjib gogo");
//     $lineDto->setEnabled(false);
//     $response = $facadeGrofence->updateGeofence($lineDto , $userToken) ;

//     var_dump($response) ;

// }


// ! get plugins

/**
 * * test the assignement of geofence to a clacs or plugin
 */

$geofence = GeofenceDto::emptyConstruct() ;
$geofence->setPluginsIds([1056778]) ;
$geofence->setCalcsIds([1705377]) ;
$geofence->setIds([3239]) ;


$res = $facadeGrofence->assignGeofenceToPC($geofence , $userToken) ;

var_dump($res) ; 
die() ;


