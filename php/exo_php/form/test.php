<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        /* Surligne les administrateurs */
        .admin {
            background-color: #fff3cd; /* jaune clair */
        }

        /* Statuts actifs et inactifs */
        .true {
            color: green;
            font-weight: bold;
        }

        .false {
            color: red;
            font-weight: bold;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .admin{
            background-color: tomato;

          
        }
        .user{
            background-color: lightblue;
        }
    </style>
    <?php
$i = 1;
while ($i <= 3):
?>
    <p>Tour n° <?= $i ?></p>
<?php
    $i++;
endwhile;
?>

<?php
$users = [
    ['nom' => 'Koffi', 'email' => 'koffi@mail.com', 'role' => 'admin', 'actif' => true],
    ['nom' => 'Dupont', 'email' => 'dupont@mail.com', 'role' => 'user', 'actif' => true],
    ['nom' => 'Nguyen', 'email' => 'anna@mail.com', 'role' => 'user', 'actif' => false],
    ['nom' => 'Diallo', 'email' => 'diallo@mail.com', 'role' => 'admin', 'actif' => false],
];


$totalUsers = count($users);


?>


<table border="1">
    <tr>
        <th>Nom</th>
        <th>email</th>
        <th>role</th>
        <th>status</th>
       
    </tr>

    <?php foreach ($users as $user): ?>
        <tr class="<?= $user['role'] === 'admin' ? 'admin' : 'user' ?>">
            <td><?= $user['nom'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td> 
           
                   <td>
                    <?php if ($user['actif']): ?>
                        true
                    <?php else: ?>
                        false
                    <?php endif; ?>
                </td>
          
        </tr>
    <?php endforeach; ?>
</table>

    <div class="message">
        <?php
     //  Message selon le nombre d'utilisateurs
        if ($totalUsers === 0) {
            echo "Aucun utilisateur enregistré pour le moment.";
        } elseif ($totalUsers === 1) {
            echo "Il y a 1 utilisateur enregistré.";
        } else {
            echo "Il y a $totalUsers utilisateurs enregistrés.";
        }
        ?>
    </div>
</body>
</html>