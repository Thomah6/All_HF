<?php

    // $formData = [];
$errors = [];

// include_once './includes/header.inc.php';
// include_once './includes/footer.inc.php';
$error = [];
require_once __DIR__ . '/../models/User.php';

class traitementlogin {
   private $userModel;

   public function __construct($pdo) {
      $this->userModel = new User($pdo); 
   }    

   public function login() {


// $users  = [
//     [ 'email' => 'nadegedjossou299@gmail.com','password' =>'nadege123'],
//     [ 'email' => 'dupont@mail.com', 'password' =>'dupont123' ],
//     [ 'email' => 'anna@mail.com', 'password' =>'anna123'],
//     [ 'email' => 'diallo@mail.com', 'password' =>'diallo123'],
// ];

//verifie si le formulaire est soumis
if($_SERVER['REQUEST_METHOD'] === 'POST') {

       $email = trim($_POST['email']);
      $password = trim($_POST['password']);


      $this->userModel->create($email, $password);
      
      $this->flashMessage("Utilisateur ajouté!","green");
    //   return $this->userModel->all();
   
 }
     
   }

   private function flashMessage($message, $color ="black") {
   echo "<p style='color:{$color}'>{$message}</p>";
}

public function getAllUsers() {
   return $this->userModel->all();
}
}
?>