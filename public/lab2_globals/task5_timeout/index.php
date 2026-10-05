<?php

session_start();

$sessionExpired = false;

// Якщо час останньої активності вже був записаний
if (isset($_SESSION["last_activity"])) {

    // Перевіряємо, чи минуло більше 5 хвилин
    if (time() - $_SESSION["last_activity"] > 300) {

        session_unset();
        session_destroy();

        $sessionExpired = true;
    }
}

// Якщо сесія не завершилась,
// записуємо час поточної активності
if (!$sessionExpired) {

    $_SESSION["last_activity"] = time();
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Час активності сесії</title>
</head>
<body>

<h1>Завдання 5. Час активності сесії</h1>

<?php

if ($sessionExpired) {

    echo "<h2>Сесію завершено.</h2>";
    echo "<p>Користувач був неактивний більше 5 хвилин.</p>";

    echo '<a href="index.php">Почати нову сесію</a>';

} else {

    echo "<h2>Сесія активна.</h2>";
    echo "<p>Час останньої активності збережено.</p>";
}

?>

</body>
</html>
