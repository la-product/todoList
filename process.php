<?php
require_once __DIR__ . '/db.php';


$name = trim($_POST['task'] ?? "");
$status = 0;

if (empty($name)) {
    header("Location: index.php?error=empty");
    exit();
}

$sql = "INSERT INTO tasklist (nazev, stav) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si", $name, $status);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php?success=1");
        exit();
    } else {
        die("Chyba databáze: " . mysqli_error($conn));
    }
} else {
    die("Chyba v SQL dotazu: " . mysqli_error($conn));
}