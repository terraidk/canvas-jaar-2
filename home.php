<?php
require('testdb.php');
$pdo = new Database();

// Fetch users
$users = $pdo->select();

// Add user
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pdo->insertUser($email, $password);
    header('Location: home.php');
}

// Edit user

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->editUser($_POST['id'], $_POST['email'], $_POST['password']);
    header('Location: home.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>

<body>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Submit">
    </form>


    <table border="2">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <?php $users = $pdo->select(); ?>
                <td>
                    <?php echo $user['id']; ?>
                </td>
                <td>
                    <?php echo $user['email']; ?>
                </td>
                <td>
                    <?php echo $user['password']; ?>
                </td>

                <td>
                    <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>