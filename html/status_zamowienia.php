<?php

if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: index.php?page=landing_page");
    exit();
}

$id = (int)($_GET['id'] ?? 0);
$status = $_GET['status'] ?? '';

$dozwolone = [
    'Przyjęte do realizacji',
    'Gotowe do odbioru',
    'Odebrane'
];

if ($id > 0 && in_array($status, $dozwolone)) {

    $sql = "UPDATE zamowienia
            SET status_zamowienia = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

header("Location: index.php?page=admin");
exit();
?>