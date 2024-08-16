<?php


namespace Fdvice\calculate\calculateIntervals ;

use Exception;
use Fdvice\calculate\calculateIntervals\CalculateIntervalInterface;
use Fdvice\CurlHelper ;

final class CalculateInterval  implements CalculateIntervalInterface
{

  function getIntervalesOfDevice($dataQuery , $credentials) : array {

      $calcsSelector = $dataQuery["calcs"] ;
      $calcDeviceIntervalsSelector  = [] ;
      $calcDevicesSelector  = $dataQuery["calc.devices"] ;
      $filter  = $dataQuery["data"] ;
      $filter["fields"] = array_key_exists("fields" ,$dataQuery) ? join("," ,$dataQuery["fields"]):"" ;
      // $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "calcs") ;
      $url = "https://flespi.io/gw/calcs/".($calcsSelector != null ?join(",",$calcsSelector) : "all")
      ."/devices/".($calcDevicesSelector != null ?join(",",$calcDevicesSelector) : "all")
      ."/intervals/".($calcDeviceIntervalsSelector != null ?join(",",$calcDeviceIntervalsSelector) : "all")
      ."?data=".urlencode(json_encode($filter));

      
      // var_dump($url) ;
      // die() ;
      $curl = CurlHelper::get($url , $credentials);
      $response = CurlHelper::excuteCurl($curl) ;

      return $response ;
      // return [$url] ;
  }

  function getLastIntervaleOfDevice($dataQuery , $credentials) : array{
      $calcsSelector = $dataQuery["calcs"] ;
      // $calcDeviceIntervalsSelector  = [] ;
      $calcDevicesSelector  = $dataQuery["calc.devices"] ;
      // $filter  = $dataQuery["data"] ;


      $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "calcs") ;
      $url = $url."/".($calcsSelector != null ?join(",",$calcsSelector) : "/all")
      ."/devices/".($calcDevicesSelector != null ?join(",",$calcDevicesSelector) : "/all")
      ."/intervals/last" ;
      // ."/intervals/".($calcDeviceIntervalsSelector != null ?join(",",$calcDeviceIntervalsSelector) : "last")
      // ."?data=".urlencode(json_encode($filter));

      $curl = CurlHelper::get($url , $credentials);
      $response = CurlHelper::excuteCurl($curl) ;


      return $response ;
      // return [$url] ;
  }

  function buildFilter($filter_List) :String {

    $filter = "";
    $filters = array();

    foreach ($filter_List as $key => $value) {
      switch ($key) {

        case 'range':
          # code...
          $dates = explode(' - ', trim($filter_List["range"], '"'));

          $formattedDates = array_map(function($date) {
              $dateParts = explode('/', trim($date));
              $formattedDate = $dateParts[1] . '-' . $dateParts[0] . '-' . $dateParts[2];
              return $formattedDate;
          }, $dates);

          if (array_key_exists("time_range", $filter_List)) {
            # code...
            $start = $formattedDates[0] . " " . $filter_List["time_range"]["start"] . ":00";
            $end = $formattedDates[1] . " " . $filter_List["time_range"]["end"] . ":00";
          }
          else {
            $start = $formattedDates[0] . " " ."00:00:00";
            $end = $formattedDates[1] . " " . "23:59:00";
          };

          // var_dump($start) ;
          // var_dump($end) ;
          // die() ;

          $start = strtotime($start);
          $end = strtotime($end);

          $start = str_replace("X" , $start , "begin >= X ");
          $end = str_replace("X" , $end , "begin <= X ");

          // if(begin >= strftime(1712077680) && end <= strftime(1712078820), 1, 0)
          $dates = "( ".$start ." && ".$end ." , 1 , error() )" ;
          $dates = "if".$dates  ;



          array_push($filters , $dates);
        break;


        case 'duration':
          // {"filter":"if(duration >= 368 && duration <= 400, true, error())","reverse":false}
          
          try {
            $min = $filter_List["duration"]["min"] * 60 ;
            $max = $filter_List["duration"]["max"] * 60 ;

            $min = str_replace("X" , $min , "duration >= X") ;
            $max = str_replace("X" , $max , "duration <= X") ;

            $duration = "if( ".$min ." && ".$max ." , true , error() )" ;
            
          } catch (\Throwable $th) {
            if(array_key_exists("min" , $filter_List["duration"]) )
            {
              $min = $filter_List["duration"]["min"] * 60 ;
              $min = str_replace("X" , $min , "duration >= X") ;
              $duration = "if( ".$min ." , true , error() )" ;
            }
            else {
              $max = $filter_List["duration"]["max"] * 60 ;
              $max = str_replace("X" , $max , "duration <= X") ;
              $duration = "if( ".$max ." , true , error() )" ;

            }
          }
          
          array_push($filters  , $duration) ;

        break;

        case 'mileage':
          # do somthing .
          // distance
            try {
              $min = $filter_List["mileage"]["min"] ;
              $max = $filter_List["mileage"]["max"];
            
              $min = str_replace("X" , $min , "distance >= X") ;
              $max = str_replace("X" , $max , "distance <= X") ;

              $mileage = "if( ".$min ." && ".$max ." , true , error() )" ;

            } catch (\Throwable $th) {
              if(array_key_exists("min" , $filter_List["mileage"]) )
              {
                $min = $filter_List["mileage"]["min"] ;
                $min = str_replace("X" , $min , "distance >= X") ;
                $mileage = "if( ".$min ." , true , error() )" ;
              }
              else {
                $max = $filter_List["mileage"]["max"] ;
                $max = str_replace("X" , $max , "distance <= X") ;
                $mileage = "if( ".$max ." , true , error() )" ;

              }
            }
            array_push($filters  , $mileage) ;
        break;

        case 'quantity':
          # code...
          try {
            $qte = $filter_List["quantity"];
          
            // $min = str_replace("X" , $min , "distance >= X") ;
            // $max = str_replace("X" , $max , "distance <= X") ;

            $qte = "if( ".$qte ."<= fuel_used"." , true , error() )" ;

          } catch (\Throwable $th) {
          }
          array_push($filters  , $qte) ;
        break;

        case 'vehicle_is_stationary':
          # code...
          try {
            $vehicle_is_stationary = $filter_List["vehicle_is_stationary"] == "true" ? 0 : true;

            $vehicle_stationary = "if( "."movement == ".$vehicle_is_stationary." , true , error() )" ;

          } catch (\Throwable $th) {
          }
          array_push($filters  , $vehicle_stationary) ;
        break;

        case 'ignition_is_off':
          # code...
          try {
            $ignition_is_off = $filter_List["ignition_is_off"] == "true" ? 0 : true;
            $qte = "if( "."ignition ==".$ignition_is_off." , true , error() )" ;

          } catch (\Throwable $th) {
            
          }
          array_push($filters  , $qte) ;
        break;

        case 'early_end':
          # code...
          try {
            $early_end = $filter_List["early_end"];
            $qte = "if( "."end < ".$early_end." , true , error() )" ;

          } catch (\Throwable $th) {
            
          }
          array_push($filters  , $qte) ;
        break;
        
        //? we used it to give the user the poisblite to get the unauthorized use of the vehicls for a given date range and given time range . 
        case 'timer':
          # code...
          try 
          {
            $timer1 = $filter_List["timer"]["timer1"];
            $timer2 = $filter_List["timer"]["timer2"];

            // !if((start_hour >= A_hour && start_minute >= A_minute) && (end_hour >= B_hour && end_minute >= B_minute))

            $T_start = "start_total_minutes" ;
            // total_minutes start_total_minutes
            $T_end = "total_minutes" ;
            $R_start = CurlHelper::time_to_minutes($timer1["start_hour"] , $timer1["start_minute"]) ;
            $R_end = CurlHelper::time_to_minutes($timer2["end_hour"] , $timer2["end_minute"]) ;

            /**
             * * Adjust R_end if it is less than R_start
             */
            list($R_start, $R_end) = CurlHelper::handle_wraparound($R_start, $R_end);

                      
            // if($T_start>$T_end , if((". $T_start + 1440."<=".$R_end.") && (".$T_end.">=".$R_start ."), true , error()) , "if((". $T_start."<=".$R_end.") && (".$T_end.">=".$R_start ."), true , error())")
            $qte = "if((". $T_start."<=".$R_end.") && (".$T_end.">=".$R_start ."), true , error())" ;
            
            // !important .. (if the start_hour > end_hour)
            // $qte = "if(".$T_start.">".$T_end.",if((". ($T_start)."<=".$R_end.") && (".($T_end ."+1440").">=".$R_start ."), true , error()),".$subqte.")" ;

          } 
          catch (\Throwable $th) {
            
            if (array_key_exists("timer1" , $filter_List["timer"])) {
              # code...
              $timer1 = $filter_List["timer"]["timer1"];
              $tim = "(start_hour >= ".$timer1["start_hour"]
              ." && ("."start_hour !=".$timer1["start_hour"].
              " || start_minute > ".$timer1["start_minute"]
              ."))" ;
            }

            else {
              $timer2 = $filter_List["timer"]["timer2"];
              $tim = "(end_hour <= ".$timer2["end_hour"]
              ." && ("."end_hour !=".$timer2["end_hour"].
              " || end_minute < ".$timer2["end_minute"]
              ."))" ;
            }
            $qte = "if( ". $tim .", true , error())" ;
            
          }
          array_push($filters  , $qte) ;
        break;

        case 'geofence_name':
          # code...
          try {
            $geofence_name = $filter_List["geofence_name"];
            $geofence_name = 'geofence_name == "'.$geofence_name.'"' ;
            $qte = "if( ". $geofence_name.", true , error())" ;


          } catch (\Throwable $th) {
            
            return new Exception($th->getMessage()) ;
          }
          array_push($filters  , $qte) ;
        break;



        // case 'end_hour':
        //   # code...
        //   try {
        //     $end_hour = $filter_List["end_hour"];
        //     $qte = "if( "."end_hour <= ".$end_hour." , true , error() )" ;

        //   } catch (\Throwable $th) {
            
        //   }
        //   array_push($filters  , $qte) ;
        // break;

        default:

        break;
      }
    }

    $filter = implode(" && " , $filters);

    // var_dump($filter) ;
    // die();
    return $filter ;

  }


}
