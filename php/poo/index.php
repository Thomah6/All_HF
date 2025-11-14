<?php
class User{
    public $nom;
    public $prenom;
    public $email;
    public function __construct($nom,$prenom,$email)
    {
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function AfficherInfos(){
        return "User:<br>".$this->nom."<br>".$this->prenom."<br>".$this->email;
    }
}
class Person{
    public $nom;
    public function Saluer(){
        return "Bonjour, je suis: ".$this->nom."<br>";
    }
}




$user = new User("Hounkonnou","Hermès","mail@gmail.com");
echo $user->AfficherInfos();

echo "<br><br>";

$person = new Person();
$person->nom=$user->nom." ". $user->prenom;
echo $person->Saluer();
?>