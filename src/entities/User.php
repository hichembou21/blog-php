<?php 
namespace app\entities;

class User {
    private $id;
    private $username;
    private $blog;    
    private $email;
    private $password;
    private $gender;
    private $avatar;

    public function __construct(string $username, string $blog, string $email, string $password,int $gender,string $avatar, int $id=null) {
        $this->username = $username;
        $this->blog = $blog;        
        $this->email = $email;
        $this->password = $password;
        $this->gender = $gender;
        $this->avatar = $avatar;
        $this->id = $id;
        
    }

    /**
     * Get the value of userName
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of blog
     */ 
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Set the value of blog
     *
     * @return  self
     */ 
    public function setBlog($blog)
    {
        $this->blog = $blog;

        return $this;
    }
}

?>