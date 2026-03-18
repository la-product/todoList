<?php

 require_once __DIR__ . '/db.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $newStatus = (int)$_GET['status'];

    $sql = "UPDATE tasklist SET stav = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $newStatus, $id);
    
    mysqli_stmt_execute($stmt);
}

header("Location: index.php");
exit();