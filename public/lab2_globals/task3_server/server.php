<?php

// Якщо сторінка відкрита не методом POST,
// повертаємо користувача на головну сторінку
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про сервер</title>
</head>
<body>

<h1>Інформація про сервер та запит</h1>

<?php

echo "IP-адреса клієнта: " . $_SERVER["REMOTE_ADDR"] . "<br><br>";

echo "Браузер: " . $_SERVER["HTTP_USER_AGENT"] . "<br><br>";

echo "Назва скрипта: " . $_SERVER["PHP_SELF"] . "<br><br>";

echo "Метод запиту: " . $_SERVER["REQUEST_METHOD"] . "<br><br>";

echo "Шлях до файлу на сервері: " . $_SERVER["SCRIPT_FILENAME"] . "<br><br>";

?>

<a href="index.php">Повернутися назад</a>

</body>
</html>
