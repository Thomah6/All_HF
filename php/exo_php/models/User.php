<?php

require_once __DIR__ . '/../config/database.php';

class User{
    private $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    function create($email, $password){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (email, password) VALUES (:email, :passwordHash)";
    
        $stmt = $this->pdo->prepare($query);
    
        return $stmt->execute([
            "email"=>$email,
           "passwordHash"=>$passwordHash
        ]);
    }

  public function all() {
   return $this->pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
  }

    }

 

?>