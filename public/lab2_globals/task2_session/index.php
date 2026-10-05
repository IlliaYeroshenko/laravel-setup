<?php

session_start();

// Обробка форми входу
if (isset($_POST["login_button"])) {

    $login = $_POST["login"];
    $password = $_POST["password"];

    // Простий приклад логіна та пароля
    if ($login == "admin" && $password == "1234") {

        $_SESSION["user"] = $login;

        header("Location: index.php");
        exit;

    } else {

        $error = "Неправильний логін або пароль.";
    }
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Робота з SESSION</title>
</head>
<body>

<h1>Завдання 2. Робота з $_SESSION</h1>

<?php

if (isset($_SESSION["user"])) {

    echo "<h2>Вітаю, " . $_SESSION["user"] . "!</h2>";

    echo '<a href="logout.php">Вихід</a>';

} else {

    if (isset($error)) {
        echo "<p>" . $error . "</p>";
    }

?>

<form method="POST">

    <label>Логін:</label>
    <input type="text" name="login">

    <br><br>

    <label>Пароль:</label>
    <input type="password" name="password">

    <br><br>

    <input type="submit" name="login_button" value="Увійти">

</form>

<?php

}

?>

</body>
</html>
