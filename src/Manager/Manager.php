<?php

namespace App\Manager;
use PDO;

abstract class Manager
{
    protected function connectDB()
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
}