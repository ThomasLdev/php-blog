<?php

namespace OC\Blog\Model;

class Manager
{
    protected function connectDB()
    {
        try {
            return new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Error : '.$e->getMessage());
        }
    }
}