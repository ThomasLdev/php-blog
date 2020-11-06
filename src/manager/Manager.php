<?php

namespace OC\Blog\Model;
use PDO;

class Manager
{
    protected function connectDB()
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
    }
}