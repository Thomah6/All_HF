    <?php
    $errors=[];
class MyException extends Exception {}
function veriFyInfos($nom,$age,$email){
    if(strlen($nom) < 3){
        throw new MyException("Le nom doit contenir au moins 3 caractères");
    }
    if($age <18 ){
        throw new MyException("Vous etes mineure");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        throw new MyException("L'email est invalide");
    }
}


if(isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['email'])){
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    try {
        veriFyInfos($nom,$age,$email);
    } catch (MyException $e) {
        $errors[] = $e->getMessage();
    }
}


    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="w-full min-h-screen flex items-center justify-center">
    <div class="w-lg">
        <div class="<?= count($errors) > 0 ? 'block' : 'hidden' ?> w-full bg-red-500 text-white p-5 mb-5">
    <h1 class="font-bold text-2xl">Erreur</h1>
    <ul>
        <?php
if($errors){
    foreach($errors as $error){
        echo "<li class='text-lg'>".$error."</li>";
    }
}
?>
    </ul>
</div>
<div class="bg-white p-5 shadow-md rounded-md">
<form action=""  class="w-full grid gap-5" method="post">
        <input type="text" class="border border-gray-200 rounded-md p-2" name="nom" placeholder="Nom et prénom" id="nom">
        <input type="number" class="border border-gray-200 rounded-md p-2" name="age" placeholder="age" id="age">
        <input type="email" class="border border-gray-200 rounded-md p-2" name="email" placeholder="Email" id="email">
        <input type="submit" class="bg-blue-500 text-white rounded-md p-2" value="Envoyer">
    </form>
</div>
    
    </div>
    </div>

</body>
</html>