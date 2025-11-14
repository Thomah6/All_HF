<?php
$users = [
    ['nom' => 'Koffi', 'email' => 'koffi@mail.com', 'role' => 'admin', 'actif' => true],
    ['nom' => 'Dupont', 'email' => 'dupont@mail.com', 'role' => 'user', 'actif' => true],
    ['nom' => 'Nguyen', 'email' => 'anna@mail.com', 'role' => 'user', 'actif' => false],
    ['nom' => 'Diallo', 'email' => 'diallo@mail.com', 'role' => 'admin', 'actif' => false],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
</head>
<style>
    .admin {
        background-color: #4CAF50;
    }
    .user {
        background-color: #919191ff;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<body>
    

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actif</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr class="<?php echo $user['role']== 'admin' ? 'admin' : 'user'; ?>">
            <td><?php echo $user['nom']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td><?php echo $user['actif'] ? 'Oui' : 'Non'; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</body>
</html>