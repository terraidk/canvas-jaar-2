<?php

include 'testdb.php';
$pdo = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->editUser($_POST['id'], $_POST['email'], $_POST['password']);
        header('Location: home.php?Success');
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>

<body>
    <?php if (isset($user)): ?>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="email">E-mail</label>
            <input type="email" name="email" value="<?php echo $person['email']; ?>" required><br><br>

            <label for="password">Password</label>
            <input type="text" name="password" value="<?php echo $person['password']; ?>" required><br><br>

            <input type="submit" class="editbutton" value="Edit">
        </form>
    <?php else: ?>
        <p>Geen persoon gevonden met het opgegeven ID.</p>
    <?php endif; ?>
</body>

</html>