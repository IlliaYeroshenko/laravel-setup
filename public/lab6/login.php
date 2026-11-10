<?php

session_start();

require_once "db.php";

$message = "";

if (isset($_SESSION["user_id"])) {
    header("Location: Welcome.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (
        empty($username) ||
        empty($password)
    ) {

        $message = "Заповніть усі поля.";

    } else {

        // Підготовлений запит
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, username, password
             FROM users
             WHERE username = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $username
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user = mysqli_fetch_assoc($result);

        if (
            $user &&
            password_verify(
                md5($password),
                $user["password"]
            )
        ) {

            $_SESSION["user_id"] = $user["id"];

            $_SESSION["username"] = $user["username"];

            header("Location: Welcome.php");
            exit;

        } else {

            $message =
                "Неправильне ім'я користувача або пароль.";
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>

<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
</head>

<body>

<h1>Авторизація користувача</h1>

<?php

if ($message != "") {
    echo "<p><b>" . $message . "</b></p>";
}

?>

<form method="POST">

    <label>Ім'я користувача:</label>

    <input
        type="text"
        name="username"
    >

    <br><br>

    <label>Пароль:</label>

    <input
        type="password"
        name="password"
    >

    <br><br>

    <input
        type="submit"
        value="Увійти"
    >

</form>

<br>

<a href="register.php">
    Зареєструватися
</a>

</body>

</html>

<?php

mysqli_close($conn);

?>
