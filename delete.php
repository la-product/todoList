<?php

 require_once __DIR__ . '/db.php';

 $id = (int)$_GET['id'];
 $sql = "DELETE FROM tasklist WHERE id =?";
 $stmt = mysqli_prepare($conn, $sql);

 mysqli_stmt_bind_param($stmt, "i", $id);
 mysqli_stmt_execute($stmt);

 header("Location: index.php");
 exit();