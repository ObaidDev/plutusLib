<?php

namespace Fdvice\handlers\base ;

interface Handler {

    public function setNext(Handler $handler);
    public function handle($handler);
}