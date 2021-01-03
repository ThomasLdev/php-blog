<?php

namespace App\Manager;
use App\Entity\User;

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

    public function getUser(string $userEmail, string $userPassword)
    {
        $user = null;
        $query= $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(['email' => $userEmail]);
        $userSQL = $query->fetch();
        if (password_verify($userPassword, $userSQL['password']))
        {
            $user = $this->hydrateUser($userSQL);
        }
        return $user;
    }

    private function hydrateUser(array $userSQL): User
    {
        $user = new User();
        $user->setFirstName($userSQL['first_name']);
        $user->setLastName($userSQL['last_name']);
        $user->setEmail($userSQL['email']);
        $user->setPassword($userSQL['password']);
        $user->setThumbnail($userSQL['thumbnail']);
        $user->setAdmin($userSQL['is_admin']);
        return $user;
    }
}
