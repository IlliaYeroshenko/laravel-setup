<?php

require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (
        empty($username) ||
        empty($email) ||
        empty($password)
    ) {

        $message = "Заповніть усі поля.";

    } else {

        // Перевірка, чи користувач вже існує
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id FROM users
             WHERE username = ? OR email = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $username,
            $email
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {

            $message =
                "Користувач з таким ім'ям або email вже існує.";

        } else {

            /*
             * У методичці для реєстрації вказано md5(),
             * а для входу password_verify().
             * Тому спочатку використовуємо md5(),
             * після чого створюємо хеш, який можна
             * перевірити через password_verify().
             */

            $md5Password = md5($password);

            $hashedPassword = password_hash(
                $md5Password,
                PASSWORD_DEFAULT
            );

            $insert = mysqli_prepare(
                $conn,
                "INSERT INTO users
                (username, email, password)
                VALUES (?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $insert,
                "sss",
                $username,
                $email,
                $hashedPassword
            );

            if (mysqli_stmt_execute($insert)) {

                $message = "Реєстрація успішна.";

            } else {

                $message = "Помилка реєстрації.";
            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>

<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>

<body>

<h1>Реєстрація користувача</h1>

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

    <label>Email:</label>

    <input
        type="email"
        name="email"
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
        value="Зареєструватися"
    >

</form>

<br>

<a href="login.php">
    Перейти до авторизації
</a>

</body>

</html>

<?php

mysqli_close($conn);

?>
