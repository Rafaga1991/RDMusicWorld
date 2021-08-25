<?php

class User extends Connection{
    private $table = 'user';

    public function __construct()
    {
        if(!parent::tableExists($this->table)){
            parent::execNoQuery("CREATE TABLE $this->table(
                idUser INTEGER(10) PRIMARY KEY AUTO_INCREMENT, 
                username VARCHAR(50) NOT NULL, userpassword VARCHAR(50) NOT NULL, 
                privileges BOOLEAN DEFAULT FALSE,  date TIMESTAMP DEFAULT NOW(), 
                deleteUser BOOLEAN DEFAULT FALSE
            )");
        }
    }

    public function isAccess(array $login){
        $data = parent::getData("SELECT * FROM $this->table 
            WHERE username='{$login['username']}' 
            AND userpassword=MD5('{$login['password']}') 
            AND NOT deleteUser"
        );

        if(count($data) == 1){
            $_SESSION = $data[0];
            $_SESSION['LOGIN'] = true;
        }
        return count($data) == 1;
    }

    public function newUser(array $register){
        parent::execNoQuery("INSERT INTO $this->table(username,userpassword) VALUE('{$register['username']}', MD5('{$register['password']}'))");
    }

    public function exists(string $username){
        return count(parent::getData("SELECT * FROM $this->table WHERE username='$username'")) > 0;
    }

    public function getUsers(){
        return parent::getData("SELECT * FROM $this->table WHERE NOT deleteUser");
    }

    public function getUser(int $idUser){
        return parent::getData("SELECT * FROM $this->table WHERE NOT deleteUser AND idUser = $idUser")[0];
    }
}