<?php 
$coLOR="blue";
$COLOR="Green";
$nom= "Alice";
$age=25;
$estEtudiant = true;
?>
<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!"
?> 

<p>Je suis Hermès Hounkonnou et je suis dev web fullstack</p>
<?php
echo "Nous somdddmgfes entrain  de commencer avec le langage PHP";
?>

<br>

<?php
$color = "red";
echo "My car is " . $color . "<br>";
echo "My house is " . $COLOR . "<br>";
echo "My boat is " . $coLOR . "<br>";
?>
<?= $color ?>
<?php echo "Bonjour je suis ", $nom, " j'ai ", $age, " ans"?>
<h2>Fonction mathématique</h2>

<?php
echo(pi());
echo "<br>";
echo(min(0, 150, 30, 20, -8, -200));
echo "<br>";
echo(abs(-4.2));
echo "<br>";
echo(max(0, 150, 30, 20, -8, -200));
echo "<br>";
echo(sqrt(16));
echo "<br>";
echo(round(0.6));
echo "<br>";
echo(round(0.4));
echo "<br>";
echo(rand(1, 6));
?>

<?php 
echo "Nombre aléatoire de 0 et 1 <br>";
echo rand(0, 100)/100;    
?>

<br>
<!-- Variables globales -->
 <?php

$x = 75;
function myFunction(){
    global $x;
    echo $x;
}

myFunction();


 ?>

<form method="POST" action="" >
    Name: <input type="text" name="nom">
    <input type="submit">
</form>
<?php 
if(isset($_POST["nom"])){
    echo "Bonjour " . $_POST["nom"];
}
?>


<?php
function compteur(){
    static $nombre = 0;
    $nombre++;
    echo $nombre ."<br>";
}

compteur();
compteur();
compteur();


 $num=0;

function compt(){
    global $num;
    $num++;
    echo $num ."<br>";
}

compt();
compt();
compt();
?>


<?php
$a = 5;       // Integer
$b = 5.34;    // Float
$c = "hello"; // String
$d = true;    // Boolean
$e = NULL;    // NULL

$a = (string) $a;
$b = (string) $b;
$c = (string) $c;
$d = (string) $d;
$e = (string) $e;

//To verify the type of any object in PHP, use the var_dump() function:
var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);

?>


<h2>Print</h2>
<?php
$nom2 ="Bob";
$result = print("Salut".$nom2."<br>");
print("Salut ".$nom2." <br>");

print($result);

echo "Valeur retournée par print: " . $result . "<br>";

?>
<h2>Printr</h2>
<?php

$fruits = ["Pomme", "Banane", "cerise"];
echo "<h3>print_r</h3>";
print_r($fruits);
echo "<br>";

$fruitss_str = print_r($fruits,true);
echo "print_r retourné :  $fruitss_str";

?>
<h3>var_dump</h3>
<?php

$valeurs = ["Alice", "Bob", "Charlie"];
$prix = 19.99;
var_dump($valeurs);
echo "<br>";
var_dump($prix);

?>

<h3>strlen</h3>
<?php

$nom = "Alice";
echo strlen($nom);

?>


<h3>str_word_count</h3>
<?php

$nom = "Alice";
echo str_word_count($nom);

?>
<h3>strpos</h3>
<?php

$nom = "Alice";
echo strpos($nom, "c");

?>

<h3>Première majuscule</h3>
<?php

function firstUpperCase($strimng){
    echo ucwords($strimng);
}

firstUpperCase("alice est une jolie fille");

?>

<h3>EXO</h3>
<?php

function longestWord($string){
    $words = str_word_count($string, 1);
    $longestWord = $words[0];
    foreach($words as $word){
        if(strlen($word) > strlen($longestWord)){
            $longestWord = $word;
        }
    }
    return strlen($longestWord);
}
echo longestWord("alice est une joliegg fillegrrtrt");
?>


<h3></h3>
<form action="index.php" method="POST">
    <label>Entrez votre nom :</label>
    <input type="text" name="nom">
    <button type="submit">Envoyer</button>
</form>
 
<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère la valeur du champ "nom"
    $nom = htmlspecialchars($_POST['nom']);
 
    // Vérifie si le champ est vide
    if (empty($nom)) {
        echo "Erreur : Veuillez entrer un nom.";
    } else {
        echo "Bonjour, $nom !";
    }
}
?>



</body>
</html>
