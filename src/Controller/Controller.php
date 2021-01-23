<?php

namespace App\Controller;

use App\Entity\User;
use Twig\Environment;

abstract class Controller
{

    protected Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    protected function getUser(): ?User
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    protected function isAdmin(): bool
    {
        $user = $this->getUser();
        if ($user && $user->getAdmin() === 1) {
            return true;
        }
        return false;
    }

    protected function checkAdmin()
    {
        if ($this->isAdmin() == false) {
            echo $this->twig->render('403.html.twig');
            exit;
        }
    }
}
