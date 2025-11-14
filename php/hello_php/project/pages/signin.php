     <?php
$title = "Connexion";
include __DIR__ . '/../includes/header.inc.php';
?>

<div>
<?php
if(isset($_GET['success'])){
?>

<div class="msg <?= $_GET["success"]===true ? "success" : "error" ?>"><?= $_GET['msg'] ?></div>
<?php
}
?>
    <form action="../controllers/login.php" method="post">
        <div>
            <label>email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit">Connecter</button>
        </div>
    </form>

</div>

<?php
include __DIR__ . '/../includes/footer.inc.php';
?>