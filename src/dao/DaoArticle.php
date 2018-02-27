<?php 

namespace app\dao;

use app\entities\Article;
use app\dao\Connect;

class DaoArticle {

    public function getAll() {
        $tab = [];
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM article');
            $query->execute();

            while($row = $query->fetch()) {
                $articles = new Article($row['title'], 
                                        $row['content'], 
                                        $row['picture'], 
                                        $row['user_id'],                                       
                                        $row['id']);
                $tab[] = $articles;
            }
        }catch(\Exception $e) {
            echo $e;
        }
            return $tab;
    }

    public function getAllUserArticle($id) {
        $tab = [];
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE user_id = :id');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);            
            $query->execute();

            while($row = $query->fetch()) {
                $article = new Article( $row['title'], 
                                        $row['content'], 
                                        $row['picture'],
                                        $row['user_id'],                                        
                                        $row['id']);
                $tab[] = $article;
            }
        }catch(\Exception $e) {
            echo $e;
        }
            return $tab;
    }

    public function getArticleById(int $id) {
        
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE id=:id');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->execute();
            if ($row = $query->fetch()) {
                $article = new Article( $row['title'], 
                                        $row['content'],
                                        $row['picture'], 
                                        $row['user_id'],                                           
                                        $row['id']);
                return $article;
            }
        }catch(\Exception $e) {
            echo $e;
        }
        return null;
    }

    public function getArticleByTitle(string $title) {
        
        try {
            $query = Connect::getInstance()->prepare('SELECT * FROM article WHERE title=:title');
            $query->bindValue(':title', $title, \PDO::PARAM_STR);
            $query->execute();
            if ($row = $query->fetch()) {
                $article = new Article( $row['title'], 
                                        $row['content'],
                                        $row['user_id'],                                           
                                        $row['id']);
                return $article;
            }
        }catch(\Exception $e) {
            echo $e;
        }
        return null;
    }
        
    public function add(Article $article, int $user_id) {
        
        try {
            $query = Connect::getInstance()->prepare("INSERT INTO article (user_id, title, content, picture) VALUE  (:user_id, :title, :content, :picture)");
            $query->bindValue(':user_id', $user_id, \PDO::PARAM_INT);            
            $query->bindValue(':title', $article->getTitle(), \PDO::PARAM_STR);
            $query->bindValue(':content', $article->getContent(), \PDO::PARAM_STR);
            $query->bindValue(':picture', $article->getPicture(), \PDO::PARAM_STR);
            
                                        
            $query->execute();
            $article->setId(Connect::getInstance()->lastInsertId());

        }catch(\Exception $e) {
            echo $e;
        }
    }

    public function update(Article $article) {
        
        try {
            $query = Connect::getInstance()->prepare(" UPDATE article SET title=:title, content=:content, picture=:picture WHERE id=:id");
            $query->bindValue(':title', $article->getTitle(), \PDO::PARAM_STR);
            $query->bindValue(':content', $article->getContent(), \PDO::PARAM_STR);
            $query->bindValue(':picture', $article->getPicture(), \PDO::PARAM_STR); 
            $query->bindValue(':id', $article->getId(), \PDO::PARAM_INT);
            
            // $query->bindValue(':id', $person->getId(), \PDO::PARAM_INT);
            
            $query->execute();

        }catch(\Exception $e) {
            echo $e;
        }
    }

    public function delete(int $id) {
        
        try {
            $query = Connect::getInstance()->prepare(" DELETE FROM article WHERE id=:id");
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            
            // $query->bindValue(':id', $person->getId(), \PDO::PARAM_INT);
            $query->execute();

        }catch(\Exception $e) {
            echo $e;
        }
    }
} 