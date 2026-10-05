<?php

// Збереження імені у cookie
if (isset($_POST["save_name"])) {

    $name = $_POST["name"];

    if (!empty($name)) {

        // Cookie зберігається 7 днів
        setcookie("lab2_username", $name, time() + 7 * 24 * 60 * 60, "/");

        header("Location: index.php");
        exit;
    }
}

// Видалення cookie
if (isset($_POST["delete_cookie"])) {

    setcookie("lab2_username", "", time() - 3600, "/");

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Робота з COOKIE</title>
</head>
<body>

<h1>Завдання 1. Робота з $_COOKIE</h1>

<?php

if (isset($_COOKIE["lab2_username"])) {

    echo "<h2>Вітаю, " . $_COOKIE["lab2_username"] . "!</h2>";

} else {

    echo "<p>Ім'я користувача ще не збережено.</p>";

}

?>

<form method="POST">

    <label>Ім'я:</label>

    <input type="text" name="name">

    <input type="submit" name="save_name" value="Зберегти ім'я">

</form>

<br>

<form method="POST">

    <input type="submit" name="delete_cookie" value="Видалити cookie">

</form>

</body>
</html>
