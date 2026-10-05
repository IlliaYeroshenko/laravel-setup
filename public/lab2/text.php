<?php

if (isset($_POST["text"])) {

    $text = $_POST["text"];

    // Записуємо текст у файл
    file_put_contents("log.txt", $text);

    echo "<h2>Текст успішно записано у файл log.txt</h2>";

    // Читаємо текст із файлу
    $fileText = file_get_contents("log.txt");

    echo "<h3>Вміст файлу:</h3>";

    echo $fileText;

    echo "<br><br>";
    echo '<a href="index.html">Повернутися на головну сторінку</a>';

} else {

    echo "Текст не був отриманий.";

}

?>
