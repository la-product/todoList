<?php
require_once __DIR__ . "/config.php";

if (!($conn = mysqli_connect("$host","$user","$pass","$dbname")))
{
  die("Nelze se připojit k databázovému serveru!" .  mysqli_connect_error());
}

mysqli_set_charset($conn, $charset);



?>