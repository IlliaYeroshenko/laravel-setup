<?php

session_start();

// Перевірка авторизації
if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>

<body>

<h1>Захищена сторінка</h1>

<h2>
    Вітаю, <?php echo $_SESSION["username"]; ?>!
</h2>

<p>
    Ви успішно авторизувалися.
</p>

<a href="logout.php">
    Вийти
</a>

</body>

</html>
