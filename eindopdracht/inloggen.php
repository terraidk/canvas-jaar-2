<?php
require("database.php");
$database = new Database();
$pdo = $database->pdo;

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
session_start();

$stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
$stmt->execute(['email' => $email, 'password' => $password]);
$user = $stmt->fetchAll();

if (isset($_POST["login"])) {
    if (!$user) {
        echo "<h2 style='color:Red'>Invalid username/password combination</h2>";
    } else {
        $_SESSION["loggedInUser"] = $user["id"];
        header("location: eindopdracht.php");

    }
}
if (isset($_POST["register"])) {
    header("location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>LOGIN</title>
    <link rel="icon" href="M logo.png">
    <link rel="stylesheet" href="inlog.css">

</head>

<body>
    <navbar>
        <button class="terug">
            <a href="eindopdracht.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </a>
        </button>
    </navbar>
    <div class="log-container">
        <h2>LOGIN</h2>
        <div class="form-container">
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
                <br>
                <label for="submit">
                    <input class="login" type="submit" name="login" value="LOGIN"><br><br>
                </label><br><br>
                <label for="forget-register">
                    <button name="register" id="forget-register" style="margin: 0 10px 0 0;">
                        Register
                    </button>
                    <button name="forgetpass" id="forget-register">I forgot my password</button>
                </label>
            </form>
        </div>
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