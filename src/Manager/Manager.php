<?php

namespace App\Manager;

abstract class Manager
{
    protected \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}