<?php

namespace Fdvice\calculate ;

use Fdvice\calculate\calculateIntervals\CalculateInterval;
use Fdvice\calculate\calculateIntervals\CalculateIntervalInterface;
use Fdvice\calculate\manage\CalculatorInterface ;
use Fdvice\calculate\manage\Calculator ;
use Fdvice\device\manage\DeviceDto ;


// require_once base_path()."/config/config-flespi.php" ;




final class FacadeCaluclateInterval
{
    // private CalculateIntervalInterface $calculateInterval ;
    private static CalculatorInterface $caluctor ;
    private static CalculateIntervalInterface $calculateInterval;

    function __construct (){
        // $this->calculateInterval = new CalculateInterval() ;
        self::$calculateInterval = new CalculateInterval();
        self::$caluctor = new Calculator();
    }

    function executeReport($data_in , $userToken , $is_last = false)  {

        // $jsonString = '{"calcs.selector": [],"calc.device.intervals.selector": [],"calc.devices.selector":[],"data":{"filter":""}}';

        // $dataQuery = json_decode($jsonString , true) ;
        
        if (!$is_last) {
            $filter = FacadeCaluclateInterval::buildFilter($data_in);
            
            $data_in["data"]["filter"] = $filter ;
            // $data_in["data"]["fields"] = $filter ;
            // var_dump($data_in);
            // die() ;
            $data_in["calcs"]= $data_in["report"] ;
            $data_in["calc.devices"] = $data_in["units"] ;

    
            $res = self::$calculateInterval->getIntervalesOfDevice($data_in , $userToken);
            return $res ;
        }
        else
        {
            $data_in["calc.devices"] = $data_in["units"] ;
            $data_in["calcs"]= $data_in["report"] ;
    
            $res = self::$calculateInterval->getLastIntervaleOfDevice($data_in , $userToken);
            return $res ;
        }

        // var_dump($filter);
        // return $filter ;



    }
    



    private static function buildFilter($filterList )  {
        // $expressions = file_get_contents($GLOBALS["expressions-interval-path"]);
        // $expressions = json_decode($expressions , true);

        $filter = self::$calculateInterval->buildFilter($filterList);
        return $filter ;
    }



    function addCalculators($userToken) : array {
        $jsonString = file_get_contents(__DIR__."/../../../config/endpoints.json");
        $reportes = json_decode($jsonString, true);

        $res = self::$caluctor->addCalculators($reportes , $userToken) ;
        return $res ;
    }

    function assigneDevices(DeviceDto $deviceDto , $userToken) : array {
        $res = self::$caluctor->assigneDevices($deviceDto , $userToken);
        return $res ;
    }

    function addCalcs($userToken) : array {
        
        $jsonString = file_get_contents(__DIR__."/../../config/calculators.json");
        $reportesRes = self::$caluctor->addCalculators(json_decode($jsonString, true) , $userToken) ;
        
        return $reportesRes ;
    }

}
