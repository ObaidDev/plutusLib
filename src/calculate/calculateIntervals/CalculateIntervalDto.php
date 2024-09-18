<?php

namespace Fdvice\calculate\calculateIntervals ;

final class CalculateIntervalDto
{
    private $units = null ;
    private $filter = null ;
    private $fields  = null ;
    private $clcs  = null ;

    // ids instead of id because whene we need the id we need a list of it not just one id .
    private $ids ;


    private function __construct() {
    
    }

    static function emptyConstruct(){
        return (new CalculateIntervalDto());
    }


    static function create($filter , $units){
        $calculateIntervalDto = new CalculateIntervalDto() ;
        $calculateIntervalDto->setFilter($filter) ;
        $calculateIntervalDto->setUnits($units) ;

        return $calculateIntervalDto;

    }



    public function getIds()
    {
        return $this->ids;
    }

    public function setIds($ids): void
    {
        $this->ids = $ids;    
    }

    // Getter and Setter for $units
    public function getUnits()
    {
        return $this->units;
    }

    public function setUnits($units): void
    {
        $this->units = $units;
    }

  

    public function getFilter()
    {
        return $this->filter;
    }

    public function setFilter($filter): void
    {
        $this->filter = $filter;
    }


    public function getFields ()
    {
        return $this->fields;
    }

    public function setFields($fields): void
    {
        $this->fields = $fields;
    }


    public function getClcs ()
    {
        return $this->clcs;
    }

    public function setClcs($clcs): void
    {
        $this->clcs = $clcs;
    }


    public function getData() {
        $data =[] ;
        ($this->getFilter() != null) ? $data["filter"]=$this->getFilter():null ;
        ($this->getFields() != null) ? $data["fields"]=$this->getFields():null ;

        return $data ;
    }


    public function _create() : array {
        
        $data = [
            "units"=>$this->getunits() ,

        ];

        return $data ;
    }


}

