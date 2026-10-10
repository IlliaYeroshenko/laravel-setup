<?php

session_start();

if (isset($_GET["clear"])) {

    unset($_SESSION["cached_data"]);
    unset($_SESSION["cached_time"]);

    header("Location: session-cache.php");
    exit;
}

function generateData()
{
    sleep(2);

    return array(
        "USD" => rand(35, 40),
        "EUR" => rand(38, 43)
    );
}

if (
    isset($_SESSION["cached_data"]) &&
    isset($_SESSION["cached_time"])
) {

    $age = time() - $_SESSION["cached_time"];

    if ($age < 600) {

        $data = $_SESSION["cached_data"];

        $source = "Дані отримано з кешу сесії.";

    } else {

        $data = generateData();

        $_SESSION["cached_data"] = $data;
        $_SESSION["cached_time"] = time();

        $source = "Кеш оновлено.";
    }

} else {

    $data = generateData();

    $_SESSION["cached_data"] = $data;
    $_SESSION["cached_time"] = time();

    $source = "Створено новий кеш.";
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кеш через сесію</title>
</head>
<body>

<h1>Кешування через PHP-сесію</h1>

<p>
    USD:
    <?php echo $data["USD"]; ?>
</p>

<p>
    EUR:
    <?php echo $data["EUR"]; ?>
</p>

<p>
    Джерело:
    <?php echo $source; ?>
</p>

<p>
    <a href="session-cache.php">
        Оновити сторінку
    </a>
</p>

<p>
    <a href="session-cache.php?clear=1">
        Очистити кеш сесії
    </a>
</p>

<p>
    <a href="index.html">
        Повернутися назад
    </a>
</p>

</body>
</html>
