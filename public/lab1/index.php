<?php

// 1. Базовий PHP-скрипт

// Виводимо текст "Hello, World!" на веб-сторінку
echo "<h2>Завдання 1. Базовий PHP-скрипт</h2>";
echo "Hello, World!";

// 2. Змінні та типи даних

echo "<h2>Завдання 2. Змінні та типи даних</h2>";

// Рядковий тип
$name = "Ілля";

// Ціле
$age = 20;

// Число з плаваючою комою
$averageGrade = 94.5;

// Логічне значення
$isStudent = true;

// Виведення значень
echo "Ім'я: " . $name . "<br>";
echo "Вік: " . $age . "<br>";
echo "Середній бал: " . $averageGrade . "<br>";
echo "Студент: " . ($isStudent ? "true" : "false") . "<br><br>";

// Виведення типів
echo "Тип змінної \$name: ";
var_dump($name);

echo "<br>Тип змінної \$age: ";
var_dump($age);

echo "<br>Тип змінної \$averageGrade: ";
var_dump($averageGrade);

echo "<br>Тип змінної \$isStudent: ";
var_dump($isStudent);

// 3. Конкатенація рядків

echo "<h2>Завдання 3. Конкатенація рядків</h2>";

$firstName = "Ілля";
$lastName = "Єрошенко";

// Об'єднуємо 2 рядки за допомогою оператора .
$fullName = $firstName . " " . $lastName;

echo "Повне ім'я: " . $fullName;

// 4. Умовні конструкції

echo "<h2>Завдання 4. Умовні конструкції</h2>";

$number = 15;

// Перевіряємо залишок від ділення числа на 2
if ($number % 2 == 0) {
    echo "Число " . $number . " є парним.";
} else {
    echo "Число " . $number . " є непарним.";
}

// 5. Цикли

echo "<h2>Завдання 5. Цикли</h2>";

echo "<b>Цикл for: числа від 1 до 10</b><br>";

for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}

echo "<br><br>";

echo "<b>Цикл while: числа від 10 до 1</b><br>";

$i = 10;

while ($i >= 1) {
    echo $i . " ";
    $i--;
}

// 6. Масиви

echo "<h2>Завдання 6. Масиви</h2>";

// Створюємо асоц. масив з інф. про студента
$student = array(
    "name" => "Ілля",
    "surname" => "Єрошенко",
    "age" => 20,
    "specialty" => "Комп'ютерні науки"
);

// Виводимо значення елем. масиву
echo "Ім'я: " . $student["name"] . "<br>";
echo "Прізвище: " . $student["surname"] . "<br>";
echo "Вік: " . $student["age"] . "<br>";
echo "Спеціальність: " . $student["specialty"] . "<br>";

// + новий ел. до масиву
$student["averageGrade"] = 94.5;

echo "<br><b>Оновлений масив:</b><br>";

echo "<pre>";
print_r($student);
echo "</pre>";

?>
