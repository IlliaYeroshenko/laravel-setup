<?php

header("Cache-Control: public, max-age=86400");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400) . " GMT");

header("Content-Type: text/css");

?>

body {
    font-family: Arial, sans-serif;
    margin: 30px;
    background-color: #f5f5f5;
}

h1 {
    color: #333;
}

h2 {
    color: #555;
}

h3 {
    margin-top: 30px;
}

img {
    width: 300px;
    margin-top: 10px;
}
