<?php

namespace Fdvice\subaccounts\grant ;


class GrantDto
{

    // [{"gid":1885256,"items":{"ids":"all","type":"gw/calcs"}}]
    private $type;
    private $ids ;
    private $gid ;


    private function __construct() {
    }

    static function emptyConstruct(){
        return (new GrantDto());
    }

    public static function create($type , $ids , $gid) {
        return (new GrantDto)->setType($type)->setIds($ids)->setGid($gid) ;
    }

    function getType() { 
         return $this->type; 
    } 
    
    function setType($type) {  
        $this->type = $type;

        return $this ;

    }

    function getIds() { 
        return $this->ids; 
    } 

   function setIds($ids) {  
       $this->ids = $ids;
       return $this ;

    }

    function getGid() { 
        return $this->gid; 
    } 

    function setGid($gid) {  
       $this->gid = $gid;
       return $this ;

    }


    public function __invoke(){
        $data = [
            'name'=> $this->getType()."-".$this->getGid(),
            'gid' => $this->getGid(),
            'items' => [
                "type"=>$this->getType()
            ],
        ];

        ($this->getIds() != null) ? $data["items"]["ids"]=$this->getIds():$data["items"]["ids"] = "all" ;
        return $data ;
    }
    
}


	
