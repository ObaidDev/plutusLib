<?php

namespace Fdvice\auth\passwd ;

interface PasswdInterface {

    function updatePasswd($dataQuery , $credentials) : array;
}