<?php

$valid_user = "admin";
$valid_pass = "password";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user = $_POST["username"];
    $pass = $_POST["password"];

    if ($user == $valid_user && $pass == $valid_pass) {

        $message = "Bienvenue " . $user . " 🎉";

        $message .= "<br>Connexion réussie";
    } else {

        $message = "Échec login pour : " . $user;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Login LAB</title>
</head>
<body>

<h2>Login (VULNÉRABLE - LAB)</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>

<p><?php echo $message; ?></p>

</body>
</html>