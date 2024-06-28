<?php


namespace Fdvice\handlers\base ;


class BaseHandler implements Handler {

    private ?Handler $next=null ;

    function setNext($next) : void {
        $this->next = $next ;
    }


    public function handle($request){
        
        if ($this->next != null) {$this->next->handle($request) ;} ;
    }
}