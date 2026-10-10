<?php

class StaticCache
{
    private static $data = null;

    public static function getData()
    {
        if (self::$data !== null) {

            return array(
                "data" => self::$data,
                "source" => "Дані отримано зі статичного кешу"
            );
        }

        sleep(2);

        self::$data = array(
            "value" => rand(1000, 9999)
        );

        return array(
            "data" => self::$data,
            "source" => "Дані згенеровано"
        );
    }
}

$first = StaticCache::getData();

$second = StaticCache::getData();

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Статичний кеш</title>
</head>
<body>

<h1>Кеш через статичну властивість класу</h1>

<h3>Перше звернення</h3>

<p>
    Значення:
    <?php echo $first["data"]["value"]; ?>
</p>

<p>
    <?php echo $first["source"]; ?>
</p>


<h3>Друге звернення</h3>

<p>
    Значення:
    <?php echo $second["data"]["value"]; ?>
</p>

<p>
    <?php echo $second["source"]; ?>
</p>

<p>
    <a href="index.html">
        Повернутися назад
    </a>
</p>

</body>
</html>
