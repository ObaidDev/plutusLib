<?php


namespace Fdvice\webhook\manage ;



final class TriggerDto 
{

    private $topic;
    private $filter;


    private function __construct() {
    
    }


    static function emptyConstruct(){
        return (new TriggerDto());
    }


    public function _create() : array {
        
        $data =[] ;
        // var_dump($this->isEnabled()) ;
        ($this->getTopic() != null) ? $data["topic"]=$this->getTopic():null ;
        ($this->getFilter() != null) ? $data["filter"]["payload"]=$this->getFilter():null ;
    
        return $data ;
    }

    public function getTopic() : string
    {
        return $this->topic;
    }

    public function setTopic($topic): void
    {
        $this->topic = $topic;
    }


    public function getFilter()
    {
        return $this->filter;
    }

    public function setFilter($filter): void
    {
        $this->filter = $filter;
    }


    
}
