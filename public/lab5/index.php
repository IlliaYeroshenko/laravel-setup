<?php

require_once "SavingsAccount.php";

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота 5</title>
</head>

<body>

<h1>Лабораторна робота 5</h1>

<h2>Об'єктно-орієнтоване програмування в PHP</h2>


<h2>1. Звичайний банківський рахунок</h2>

<?php

$account1 = new BankAccount("USD");

echo "Валюта рахунку: " . $account1->getCurrency() . "<br>";

echo "Початковий баланс: "
    . $account1->getBalance()
    . " USD<br><br>";


try {

    $account1->deposit(1000);

    echo "Поповнення рахунку: 1000 USD<br>";

    echo "Баланс: "
        . $account1->getBalance()
        . " USD<br><br>";


    $account1->withdraw(250);

    echo "Зняття коштів: 250 USD<br>";

    echo "Баланс після зняття: "
        . $account1->getBalance()
        . " USD<br>";

} catch (Exception $e) {

    echo "Помилка: " . $e->getMessage();
}

?>


<hr>


<h2>2. Перевірка недостатнього балансу</h2>

<?php

$account2 = new BankAccount("EUR");

try {

    $account2->deposit(500);

    echo "Баланс рахунку: "
        . $account2->getBalance()
        . " EUR<br>";

    echo "Спроба зняти 700 EUR...<br>";

    $account2->withdraw(700);

} catch (Exception $e) {

    echo "<b>Помилка: "
        . $e->getMessage()
        . "</b>";
}

?>


<hr>


<h2>3. Перевірка некоректної суми</h2>

<?php

$account3 = new BankAccount("USD");

try {

    echo "Спроба поповнити рахунок на -100 USD...<br>";

    $account3->deposit(-100);

} catch (Exception $e) {

    echo "<b>Помилка: "
        . $e->getMessage()
        . "</b>";
}

?>


<hr>


<h2>4. Накопичувальний рахунок</h2>

<?php

$savings = new SavingsAccount("USD");

try {

    $savings->deposit(2000);

    echo "Початковий баланс: "
        . $savings->getBalance()
        . " USD<br>";

    echo "Відсоткова ставка: "
        . (SavingsAccount::$interestRate * 100)
        . "%<br><br>";


    $interest = $savings->applyInterest();

    echo "Нараховані відсотки: "
        . $interest
        . " USD<br>";

    echo "Баланс після нарахування: "
        . $savings->getBalance()
        . " USD<br><br>";


    $savings->withdraw(300);

    echo "Знято: 300 USD<br>";

    echo "Поточний баланс: "
        . $savings->getBalance()
        . " USD<br>";

} catch (Exception $e) {

    echo "Помилка: " . $e->getMessage();
}

?>

</body>
</html>
