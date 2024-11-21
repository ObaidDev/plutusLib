<?php

namespace Fdvice\device\calcs ;


interface SelectorsInterface {
    static function emptyConstruct() ;
    public function _create() ;
    public function getCounters();
    public function getFrom() ;
    public function getTo() ;
}