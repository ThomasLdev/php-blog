<?php

namespace App\Controller;

abstract class Controller
{
    protected function sessionExists()
    {
        if ($_SESSION){
            return true;
        }
        return false;
    }
}
