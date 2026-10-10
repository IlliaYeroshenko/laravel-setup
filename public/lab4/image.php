<?php

header("Cache-Control: public, max-age=86400");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400) . " GMT");

header("Content-Type: image/svg+xml");

echo '
<svg xmlns="http://www.w3.org/2000/svg"
     width="300"
     height="150">

    <rect width="300"
          height="150"
          fill="lightblue"/>

    <text x="150"
          y="80"
          text-anchor="middle"
          font-size="24"
          fill="black">
        PHP Cache
    </text>

</svg>
';

?>
