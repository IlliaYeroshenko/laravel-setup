<?php

$directory = "uploads/";

echo "<h2>Список завантажених файлів</h2>";

// Відкриваємо директорію
$dir = opendir($directory);

// Читаємо файли
while (($file = readdir($dir)) !== false) {

    if ($file != "." && $file != "..") {

        echo $file;

        echo ' - <a href="' . $directory . $file . '" download>Завантажити</a>';

        echo "<br>";
    }
}

// Закриваємо директорію
closedir($dir);

echo "<br>";
echo '<a href="index.html">Повернутися на головну сторінку</a>';

?>
