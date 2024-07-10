<?php

namespace Fdvice\geofence\manage;

final class LineDto extends GeofenceDto
{

    private $path ;
    private ?float $width = 0.001;
    private ?string $type = "corridor";


    private function __construct() {
    
    }

    static function emptyConstruct(){
        return (new LineDto());
    }

    static function create($name , $path) : LineDto {
        $lineDto = LineDto::emptyConstruct();
        $lineDto->setName($name) ;
        $lineDto->setPath($path) ;
        // $lineDto->setWidth(0.001) ;
        // $lineDto->setType("corridor") ;

        return $lineDto ;
        
    }

    
    public function getPath() {
        return $this->path;
    }

    public function setPath($path): void {
        $this->path = $path;
    }

    public function getWidth(): ?float {
        return $this->width;
    }

    public function setWidth(?float $width): void {
        $this->width = $width;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $type): void {
        $this->type = $type;
    }
    

    



    function _create() : array {
        $data = [];

        ($this->getPath() != null ? $data["geometry"]["path"] = $this->getPath() : "nothing" ) ;
        ($this->getPath() != null ? $data["geometry"]["type"] = $this->getType() : "nothing" ) ;
        ($this->getPath() != null ? $data["geometry"]["width"] = $this->getWidth() : "nothing" ) ;
        ($this->getName() != null ? $data["name"] = $this->getName() : "nothing" ) ;
        ($this->isEnabled()  != null ? $data["enabled"] = $this->isEnabled()  : "nothing" ) ;

        // var_dump($data);
        // die() ;

        return $data ;
        return [] ;
    }


    
    
}