<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST["firstName"] ?? "";
    $lastName = $_POST["lastName"] ?? "";

    $firstName = trim($firstName);
    $lastName = trim($lastName);

    if (empty($firstName) || empty($lastName)) {

        echo "Помилка: будь ласка, заповніть усі поля.";

    } elseif (!is_string($firstName) || !is_string($lastName)) {

        echo "Помилка: введені дані мають бути текстовими.";

    } else {

        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);

        echo "<h2>Результат</h2>";
        echo "Вітаю, " . $firstName . " " . $lastName . "!";

    }

} else {

    echo "Дані не були отримані.";

}

?>
