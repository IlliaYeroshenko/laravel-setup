<?php

if (isset($_FILES["user_file"])) {

    $fileName = $_FILES["user_file"]["name"];
    $fileType = $_FILES["user_file"]["type"];
    $fileSize = $_FILES["user_file"]["size"];
    $tmpName = $_FILES["user_file"]["tmp_name"];

    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . $fileName;

    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Перевіряємо
    if (!is_uploaded_file($tmpName)) {

        echo "Помилка завантаження файлу.";

    // Перевіряємо розширення
    } elseif (
        $extension != "png" &&
        $extension != "jpg" &&
        $extension != "jpeg"
    ) {

        echo "Помилка: дозволено завантажувати тільки файли png, jpg та jpeg.";

    // Перевіряємо розмір
    } elseif ($fileSize > 2 * 1024 * 1024) {

        echo "Помилка: розмір файлу не повинен перевищувати 2 МБ.";

    // Перевіряємо, чи існує файл
    } elseif (file_exists($uploadFile)) {

        echo "Файл з таким ім'ям вже існує.<br>";
        echo "Будь ласка, змініть назву файлу та спробуйте ще раз.";

    } else {

        // Переміщуємо файл із тимчасової директорії у uploads
        if (move_uploaded_file($tmpName, $uploadFile)) {

            echo "<h2>Файл успішно завантажено</h2>";

            echo "Ім'я файлу: " . $fileName . "<br>";
            echo "Тип файлу: " . $fileType . "<br>";
            echo "Розмір файлу: " . ($fileSize / 1024) . " КБ<br><br>";

            echo '<a href="' . $uploadFile . '" download>Завантажити файл</a>';

            echo "<br><br>";
            echo '<a href="index.html">Повернутися на головну сторінку</a>';

        } else {

            echo "Помилка при збереженні файлу.";

        }
    }

} else {

    echo "Файл не був вибраний.";

}

?>
