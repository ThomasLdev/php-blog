<?php

namespace App\Manager;
use App\Entity\User;
//use App\Controller\FrontendController;

class UserManager extends Manager
{
    public function saveUser(User $user)
    {
        $request = $this->pdo->prepare('
                INSERT INTO user 
                       (first_name, last_name, email, password, thumbnail) 
                VALUES (:firstName, :lastName, :email, :password, :thumbnail)
        ');
        $request->execute([
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'thumbnail' => $user->getThumbnail()
        ]);
    }

    /*public function hydrateUser(array $userSQL): User
    {
        $user = new User();
        $user->setFirstName($userSQL['user_first_name']);
        $user->setLastName($userSQL['user_last_name']);
        $user->setEmail($userSQL['user_email']);
        $user->setPassword($userSQL['user_password']);
        $user->setThumbnail($userSQL['user_thumbnail']);
        return $user;
    }*/
}
