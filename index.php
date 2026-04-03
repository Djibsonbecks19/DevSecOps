<?php
// Connexion simulée (pas de DB pour simplifier)
$valid_user = "admin";
$valid_pass = password_hash("password", PASSWORD_BCRYPT);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = htmlspecialchars($_POST["username"]);
    $pass = $_POST["password"];

    if ($user === $valid_user && password_verify($pass, $valid_pass)) {
        $message = "Connexion réussie ✅";
    } else {
        $message = "Identifiants incorrects ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
</head>
<body>
    <h2>Login sécurisé</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <p><?php echo $message; ?></p>
</body>
</html>