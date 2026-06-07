<?php
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: index.php?page=home");
    exit();
}

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php?page=admin");
    exit();
}

if ($id === (int)$_SESSION['user_id']) {
    header("Location: index.php?page=admin&kom=Nie możesz usunąć samego siebie.");
    exit();
}

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: index.php?page=admin&kom=Użytkownik został usunięty.");
    exit();

} catch (mysqli_sql_exception $e) {
    header("Location: index.php?page=admin&kom=Błąd podczas usuwania użytkownika.");
    exit();
}