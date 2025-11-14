<?php
$title = "Accueil";
$host = $_SERVER['HTTP_HOST'];

require_once __DIR__ . '/includes/header.inc.php';
?>

<h1>Bienvenue sur notre site</h1>
<div>
<?php

if(isset($_GET['success'])){
?>
<div class="msg <?php echo $_GET["success"]==true ? "success" : "error" ?>"><?= $_GET['msg'] ? 'Connecté avec succès' : 'Echec de connexion' ?></div>
<?php
}
?>
</div>
<?php
include __DIR__ . '/includes/footer.inc.php';
?>