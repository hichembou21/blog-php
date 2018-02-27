<?php 

namespace app\dao;

use app\entities\User;
use app\dao\Connect;

class DaoUser {

    public function getAll() {
        $tab = [];
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user');
            $query->execute();

            while($row = $query->fetch()) {
                $user = new User(   $row['username'],
                                    $row['blog'],
                                    $row['email'], 
                                    $row['password'],
                                    $row['gender'],                                    
                                    $row['avatar'],                                    
                                    $row['id']);
                $tab[] = $user;
            }
        }catch(\Exception $e) {
            echo $e;
        }
            return $tab;
    }

    public function getUserById(int $id) {
        
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user WHERE id=:id');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
            if ($row = $query->fetch()) {
                $user = new User(   $row['username'],
                                    $row['blog'],                
                                    $row['email'],
                                    $row['password'],                                            
                                    $row['gender'],
                                    $row['avatar'],                                            
                                    $row['id']);
                return $user;
            }
        }catch(\Exception $e) {
            echo $e;
        }
        return null;
    }

    public function getUserByEmail(string $email) {
        
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM user WHERE email=:email');
            $query->bindValue(':email', $email, \PDO::PARAM_STR);
            $query->execute();
            if ($row = $query->fetch()) {
                $user = new User($row['username'], 
                                    $row['blog'],
                                    $row['email'],                                    
                                    $row['password'],                                            
                                    $row['gender'],
                                    $row['avatar'],                                            
                                    $row['id']);
                return $user;
            }
        }catch(\Exception $e) {
            echo $e;
        }
        return null;
    }
        
    public function add(User $user) {
        
        try {
            $query = Connect::getInstance()->prepare("INSERT INTO user (username, blog, email, password, gender, avatar) VALUE  (:username, :blog, :email, :password, :gender, :avatar)");
            $query->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
            $query->bindValue(':blog', $user->getBlog(), \PDO::PARAM_STR);            
            $query->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
            $query->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
            $query->bindValue(':gender', $user->getGender(), \PDO::PARAM_INT);
            $query->bindValue(':avatar', $user->getAvatar(), \PDO::PARAM_STR);
                                        
            $query->execute();
            $user->setId(Connect::getInstance()->lastInsertId());

        }catch(\Exception $e) {
            echo $e;
        }
    }

    public function update(User $user) {
        
        try {
            $query = Connect::getInstance()->prepare(" UPDATE user SET username=:username, blog=:blog, email=:email, password=:password, gender=:gender, avatar=:avatar WHERE id=:id");
            $query->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
            $query->bindValue(':blog', $user->getBlog(), \PDO::PARAM_STR);            
            $query->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
            $query->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
            $query->bindValue(':gender', $user->getGender(), \PDO::PARAM_INT);         
            $query->bindValue(':avatar', $user->getAvatar(), \PDO::PARAM_STR);            
            $query->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
            
            // $query->bindValue(':id', $person->getId(), \PDO::PARAM_INT);
            
            $query->execute();

        }catch(\Exception $e) {
            echo $e;
        }
    }

    public function delete($id) {
        
        try {
            $query = Connect::getInstance()->prepare(" DELETE FROM user WHERE id=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            
            // $query->bindValue(':id', $person->getId(), \PDO::PARAM_INT);
            $query->execute();

        }catch(\Exception $e) {
            echo $e;
        }
    }
} 