<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>TABLEAUX</h1>
    <h2>Tableau Indexés</h2>
<?php
$students = ["Hermes",
"Sergio",
"Nadege",
"Prince",
"Manu Jr",
"Raoul",
"Karim",
"Francis",
"Thamas",
"Alexio",
"Mathieu",
"Wariss"
];


echo "My name is " . $students[0] ."<br><br>";
$students[]="Basile";
$students[0]="Le Boss";

var_dump($students);
echo "<br><br>";
unset($students[count($students)-3]);
var_dump($students);
echo "<br><br>";
$result =array_values($students);
var_dump($result);
echo "<br><br>";
?>

<h2>Tableau associatif</h2>
<?php

$notes = [
   "html" => 20,
   "css" => 20,
   "js" => 20,
   "php" => 20,
   "mysql" => 20,
   "bootstrap" => 20,
   "jquery" => 20,
   "react" => 20,
   "node" => 20,
   "python" => 20,
   "java" => 20,
   "c#" => 20,
   "mongodb" => 17,
   "vuejs"=>20,
];

echo "Ma derniere note est " . $notes['mongodb'];
echo "<br><br>";
$notes['php']=20;
echo "Ma note en php est " . $notes['php'];
echo "<br><br>";
$notes['mongodb']=$notes['mongodb']+2;
echo "Ma note en mongodb est " . $notes['mongodb'];
echo "<br><br>";
unset($notes['css']);
echo "Ma note en css a été suppr";
echo "<br><br>";
?>


<h2>Tableau multidimenstionnel</h2>

<?php
$matrice = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
foreach($matrice as $row){
    foreach($row as $cell){
        echo $cell . " ";
    }
}

?>

<?php
array_key_exists("html", $notes);
echo array_key_exists("html", $notes);
echo "<br><br>";
sort($notes);
echo "<br><br>";
asort($notes);
echo "<br><br>";
ksort($notes);
?>

<?

$matrice = [
    [10, 20, 30, 40, 50, 60],
    [
        "nom" => "Alice",
        "age" => 25,
        "ville" => "Paris",
        "pays" => "France",
        "poste" => "Développeuse",
        "salaire" => 3000
    ],
    [
        0 => "Lundi",
        "jour" => "Mardi",
        2 => "Mercredi",
        "mois" => "Janvier",
        4 => "Février",
        "annee" => 2025
    ],
    [1, 2, 3, 4, 5, 6],
    [
        "produit" => "PC portable",
        "prix" => 850,
        "stock" => 12,
        "marque" => "Dell",
        "couleur" => "Gris",
        "garantie" => "2 ans"
    ]
];

$cleVille = array_search('ville', array_keys($matrice[1])) !== false ? 'ville' : '';

echo "Je suis " . $matrice[1]["nom"] . "et j'ai  ". $matrice[1]["age"] . "ans. Et je vis dans la ".

$cleVille
." de ". $matrice[1][$cleVille] . " et je suis ". $matrice[1]["poste"] . "et j'ai un salaire de ". $matrice[1]["salaire"] ."
et je veux acheter ". $matrice[4]["produit"] . "il coûte ". $matrice[4]["prix"] . "et il reste ". $matrice[4]["stock"] . "en stock";
?>
</body>
</html>