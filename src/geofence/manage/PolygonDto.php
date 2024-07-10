<?php

namespace Fdvice\geofence\manage;

final class PolygonDto extends GeofenceDto
{

    private $path ;
    private ?string $type = "polygon" ;


    private function __construct() {
    
    }

    static function emptyConstruct(){
        return (new PolygonDto());
    }

    static function create($name , $path) : PolygonDto {
        $polygondto = PolygonDto::emptyConstruct();
        $polygondto->setName($name) ;
        $polygondto->setPath($path) ;

        return $polygondto ;
        
    }

    
    public function getPath() {
        return $this->path;
    }

    public function setPath($path): void {
        $this->path = $path;
    }


    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $type): void {
        $this->type = $type;
    }



    function _create() : array {
        $data = [
            "geometry"=>["path"=>$this->getPath() , "type"=>$this->getType()] ,
            "name"=>$this->getName(),
            "enabled"=>$this->isEnabled() ,
        ];

        return $data ;

        return [] ;
    }


    
    
}
