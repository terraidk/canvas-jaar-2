<?php
require("database.php");

// Assuming you've instantiated the Database class and obtained the $pdo object in database.php
$database = new Database();
$pdo = $database->pdo;

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";

if (isset($_POST["register"])) {
    if (!empty($email) && !empty($password) && !empty($address)) {
        $stmt = $pdo->prepare("INSERT INTO users (email, password, address) VALUES (:email, :password, :address)");
        $stmt->execute(['email' => $email, 'password' => $password, 'address' => $address]);
        echo "<h2 style='color:Green;     backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);  '>YOU ARE REGISTERED<h2>";
    } else {
        echo "<h2 style='color:Red;     backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);  '>FAILED TO REGISTER, CHECK IF EVERYTHING IS FILLED IN<h2>";
    }
}

if (isset($_POST["inloggen"])) {
    header("location: inloggen.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="M logo.png">
    <link rel="stylesheet" href="register.css">
</head>

<body>

    <div class="log-container">
        <h2>Register</h2>

        <form action="" method="post">
            <label for="email">
                <input type="email" placeholder="email" id="email" name="email"><br>
            </label>
            <br>

            <label for="password">
                <input type="password" placeholder="password" id="password" name="password">
            </label>
            <input type="checkbox" class="showpass" id="showPassword">
            <label for="showPassword" onclick="showPassword()">Show Password</label>
            <br>
            <label for="address">
                <input type="address" placeholder="address" id="address" name="address">
            </label>
            <br>
            <br>
            <label for="register">
                <button name="register" id="register" style="margin: 0 10px 0 0;">
                    Register
                </button>
            </label>
            <br>
            <br>
            <label for="backtologin">
                <button name="inloggen" id="login" style="margin: 0 10px 0 0;" href="inloggen.php">
                    Back to login
                </button>
            </label>
        </form>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>
</body>

</html>