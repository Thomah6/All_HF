<?php

// class Compte
// {
//     private $solde;
//     public function __construct()
//     {
//         $this->solde = "10000000";
//     }

//     public function getSolde()
//     {
//         return $this->solde;
//     }
//     public function setSolde($solde)
//     {
//         $this->solde = $this->verifSolde($solde)? $this->solde+$solde : 'Operation non autorisee';
//     }
//     public function verifSolde($solde)
//     {
//         return $this->solde+$solde > 0;
//     }

//     public function Response($content)
//     {
//         echo $content;
//     }
// }




// $compte = new Compte();

// echo $compte->getSolde();
// $compte->setSolde(900000);
// echo "<br>";
// echo $compte->getSolde();

?>


<?php
// echo "<br><br>";

// interface Crier{
//     public function Crier();
// }

// abstract class Animal implements Crier{
//     public $category;
//     public $nom;
//     public function __construct($category,$nom){
//         $this->category = $category;
//         $this->nom = $nom;
//     }
//     abstract public function Crier();

// }

// class Chien extends Animal{
//     public function Crier(){
//         return $this->nom." fait Wouf Wouf";
//     }
// }

// class Chat extends Animal{
//     public function Crier(){
//         return $this->nom." fait Miaou Miaou";
//     }
// }


// echo "<br><br>";
// $chien = new Chien("Chien","Max");
// echo $chien->Crier();
// echo "<br><br>";
// $chat = new Chat("Chat","Miaou");
// echo $chat->Crier();

?>


<h2>Exercice 1</h2>
<?php

class Vehicule
{
    public function rouler()
    {
        return "roule";
    }
}

class Voiture extends Vehicule
{
    public function rouler()
    {
        return "Le voiture roule";
    }
}

class Moto extends Vehicule
{
    public function rouler()
    {
        return "La moto roule";
    }
}


$voiture = new Voiture();
echo $voiture->rouler();
echo "<br><br>";
$moto = new Moto();
echo $moto->rouler();
?>


<h2>Exercice 2</h2>
<?php
abstract class Personnage
{
    abstract public function Attaquer();
}

class Guerrier extends Personnage
{
    public function Attaquer()
    {
        return "Attaque avec une hache";
    }
}

class Mage extends Personnage
{
    public function Attaquer()
    {
        return "Attaque avec un sort";
    }
}


$guerrier = new Guerrier();
echo $guerrier->Attaquer();
echo "<br><br>";
$mage = new Mage();
echo $mage->Attaquer();
?>

<h2>Exercice 3</h2>
<?php

interface MoyenTransport
{
    public function deplacer();
}
class Train implements MoyenTransport
{
    public function deplacer()
    {
        return "Le train roule";
    }
}

class Bateau implements MoyenTransport
{
    public function deplacer()
    {
        return "Le bateau roule";
    }
}

$train = new Train();
echo $train->deplacer();
echo "<br><br>";
$bateau = new Bateau();
echo $bateau->deplacer();
?>

<h2>Exercice 4</h2>
<?php

function division($a, $b)
{
    if ($b == 0) {
        throw new Exception("Division par zero interdite");
    }
    return $a / $b;
}

try {
    echo division(10, 0);
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    echo "<br>Tout c'est bien passé";
}

?>
<h2>Exercice 5: Exception personnalisé</h2>
<?php

class MyException extends Exception {}
function age($age)
{
    if ($age < 18) {
        throw new MyException("Vous n'avez pas le droit d'acceder a ce contenu car vous etes mineur");
    } else {
        throw new MyException("Vous pouvez accéder au contenu.");
    }
}
echo "<br>";
try {
    age(18);
} catch (MyException $e) {
    echo $e->getMessage();
}

?>



<h2>Execice 6</h2>
<?php

class Produit{
    private $nom;
    private $prix;
    public function __construct($nom,$prix){
        $this->nom = $nom;
        $this->prix = $prix;
    }


}

// echo new Produit("Produit",100);

class Personne{
    public $age;
    public $nom;

    public function __construct($age,$nom){
        $this->age = $age;
        $this->nom = $nom;
    }
    public function __toString(){
        return "Nom: ". $this->nom ."Age: ". $this->age;
    }
} 

class Banque{
    private $solde;
    public function __construct($solde){
        $this->solde = $solde;
    }
    public function __get($solde){
        return "Accès Interdit";
    }
    public function __set($solde,$valeur){
        return "Modification Interdit";
    }
}

$banque = new Banque(100);
echo $banque->solde;
$banque->solde = 100;
echo $banque->solde;
?>