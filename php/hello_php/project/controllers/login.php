<?php
$users = [
    ["nom" => "Fadel","email" => "fadel@gmail.com", "password" => "123456"],
    ["nom" => "Julie","email" => "julie@gmail.com", "password" => "789123"],
    ["nom" => "Tomy","email" => "tomy@gmail.com", "password" => "456789"]
];
if($_SERVER["REQUEST_METHOD"] === "POST"){ 

$formData = [
   "email"=>$_POST["email"],
   "password"=>$_POST["password"],
];
if($formData["email"] === "" || $formData["password"] === ""){
   header('Location: /pages/signin.php?success=false&msg=Echec');
}
$emails = [];

foreach($users as $user){
    $emails[] = $user["email"];
}

if(in_array($formData["email"], $emails)){
    $isPasswordCorrect = false;
    foreach($users as $user){
        if($formData["email"] === $user["email"] && $formData["password"] === $user["password"]){
            $isPasswordCorrect = true;
            break;
        }
    }
    if($isPasswordCorrect){
        header('Location: /index.php?success=true&msg=Success');
    }else{
        header('Location: /pages/signin.php?success=false&msg=Mauvais mot de passe');
    }
}else{
    header('Location: /pages/signin.php?success=false&msg=Mauvais email');
}


}else{
   header('Location: /pages/signin.php?success=false&msg=Echec');
}

?>