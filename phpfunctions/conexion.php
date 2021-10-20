<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ai13", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET CHARACTER SET UTF8");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>