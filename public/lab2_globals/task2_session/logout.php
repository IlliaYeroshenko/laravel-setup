<?php

session_start();

// Очищення даних сесії
session_unset();
session_destroy();

// Повернення на головну сторінку
header("Location: index.php");
exit;

?>
