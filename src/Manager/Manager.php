<?php

namespace App\Manager;

use PDO;

abstract class Manager
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}