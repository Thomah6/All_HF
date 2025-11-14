<?php

$title="Dashboard";

include __DIR__ . '/../includes/header.inc.php';

?>

<div>
<h1>Dashboard</h1>
<?php

if(isset($_GET['success'])){
?>
<div class="msg <?php echo $_GET["success"]==true ? "success" : "error" ?>"><?= $_GET['msg'] ? 'Connecté avec succès' : 'Echec de connexion' ?></div>
<?php
}
?>
</div>

<?php
include __DIR__ . '/../includes/footer.inc.php';