<?php

$cacheFile = "cache/report.html";
$cacheTime = 600;

if (isset($_GET["clear"])) {

    if (file_exists($cacheFile)) {
        unlink($cacheFile);
    }

    header("Location: generate-report.php");
    exit;
}

if (
    file_exists($cacheFile) &&
    (time() - filemtime($cacheFile) < $cacheTime)
) {

    $report = file_get_contents($cacheFile);
    $source = "Дані отримано з кешу.";

} else {

    sleep(3);

    $names = array(
        "Іван",
        "Марія",
        "Олександр",
        "Анна",
        "Петро"
    );

    $report = "<table border='1' cellpadding='5'>";
    $report .= "<tr>";
    $report .= "<th>№</th>";
    $report .= "<th>Ім'я</th>";
    $report .= "<th>Сума</th>";
    $report .= "<th>Дата</th>";
    $report .= "</tr>";

    for ($i = 1; $i <= 1000; $i++) {

        $name = $names[array_rand($names)];

        $sum = rand(100, 10000);

        $date = date(
            "Y-m-d",
            time() - rand(0, 30) * 86400
        );

        $report .= "<tr>";

        $report .= "<td>" . $i . "</td>";
        $report .= "<td>" . $name . "</td>";
        $report .= "<td>" . $sum . "</td>";
        $report .= "<td>" . $date . "</td>";

        $report .= "</tr>";
    }

    $report .= "</table>";

    file_put_contents($cacheFile, $report);

    $source = "Створено новий кеш. Генерація зайняла близько 3 секунд.";
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Файлове кешування</title>
</head>
<body>

<h1>Файлове кешування</h1>

<p>
    <?php echo $source; ?>
</p>

<p>
    <a href="generate-report.php?clear=1">
        Очистити файловий кеш
    </a>
</p>

<p>
    <a href="index.html">
        Повернутися на головну сторінку
    </a>
</p>

<?php

echo $report;

?>

</body>
</html>
