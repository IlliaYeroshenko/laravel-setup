<?php

session_start();

// Створюємо корзину, якщо її ще немає
if (!isset($_SESSION["cart"])) {

    $_SESSION["cart"] = array();
}


// Додавання товару
if (isset($_POST["add_product"])) {

    $product = $_POST["product"];

    $_SESSION["cart"][] = $product;

    header("Location: index.php");
    exit;
}


// Завершення поточного сеансу
if (isset($_POST["finish_session"])) {

    // Отримуємо попередні покупки з cookie
    if (isset($_COOKIE["previous_purchases"])) {

        $previous = explode("|", $_COOKIE["previous_purchases"]);

    } else {

        $previous = array();
    }

    // Об'єднуємо старі покупки з поточною корзиною
    $allPurchases = array_merge($previous, $_SESSION["cart"]);

    // Зберігаємо покупки у cookie на 7 днів
    setcookie(
        "previous_purchases",
        implode("|", $allPurchases),
        time() + 7 * 24 * 60 * 60,
        "/"
    );

    session_unset();
    session_destroy();

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>
</head>
<body>

<h1>Завдання 4. Корзина покупок</h1>

<form method="POST">

    <label>Оберіть товар:</label>

    <select name="product">

        <option value="Ноутбук">Ноутбук</option>
        <option value="Миша">Миша</option>
        <option value="Клавіатура">Клавіатура</option>

    </select>

    <input type="submit" name="add_product" value="Додати">

</form>


<h2>Поточна корзина</h2>

<?php

if (count($_SESSION["cart"]) > 0) {

    foreach ($_SESSION["cart"] as $product) {

        echo $product . "<br>";
    }

} else {

    echo "Корзина порожня.";
}

?>


<h2>Попередні покупки</h2>

<?php

if (isset($_COOKIE["previous_purchases"])) {

    $previous = explode("|", $_COOKIE["previous_purchases"]);

    foreach ($previous as $product) {

        echo $product . "<br>";
    }

} else {

    echo "Попередніх покупок немає.";
}

?>

<br><br>

<form method="POST">

    <input type="submit"
           name="finish_session"
           value="Завершити сеанс">

</form>

</body>
</html>
