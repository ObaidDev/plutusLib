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

    private $begin ;
    private $end ;
    private $reverse ;

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

    public function getBegin ()
    {
        return $this->begin;
    }

    public function setBegin(int $begin): void
    {
        $this->begin = $begin;
    }

    public function getEnd ()
    {
        return $this->end;
    }

    public function setEnd(int $end): void
    {
        $this->end = $end;
    }

    public function getData() {
        $data =[] ;
        ($this->getFilter() != null) ? $data["filter"]=$this->getFilter():null ;
        ($this->getFields() != null) ? $data["fields"]=$this->getFields():null ;
        ($this->getBegin() != null) ? $data["begin"]=$this->getBegin():null ;
        ($this->getEnd() != null) ? $data["end"]=$this->getEnd():null ;

        return $data ;
    }


    public function _create() : array {
        
        $data = [
            "units"=>$this->getunits() ,

        ];

        return $data ;
    }


}

