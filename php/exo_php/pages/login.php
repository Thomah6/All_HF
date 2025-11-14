
<?php
$success = false;

require_once __DIR__ . '/../controllers/traitementlogin.php';
require_once __DIR__ . '/../config/database.php';

$controller = new traitementlogin($pdo);
$controller->login();

$users = $controller->getAllUsers();


?>

<?php

$errors = [];
if(empty($errors)){
    $success = true;
}
?>
  <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <strong>⚠️ Erreurs détectées :</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <strong>✅ Formulaire soumis avec succès !</strong>
            </div>
        <?php endif; ?>
<form method="POST" >
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit" name="validate"  class="btn-submit">Se connecter</button>
    </div>
</form>

<div>
    <h2>Liste des utilisateurs</h2>

    <table>
        <tr>
            <th>Id</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $key => $user): ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['email']?></td>
            </tr>
        <?php endforeach; ?>
             <tr>
            <th><?=$user['id']?>Id</th>
            <th><?=$user['email']?>Email</th>
            <th>Action</th>
        </tr>
    </table>
</div>




<style>

    form{
        display: flex;
        flex-direction: column;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .btn-submit{
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    div{
        margin-bottom: 20px;
    }
 input{
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
 }
</style>

