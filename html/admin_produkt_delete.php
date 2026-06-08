<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: landing_page");
    exit();
}

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: admin_produkty");
    exit();
}

$sql = "SELECT obrazek FROM produkty WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produkt = $result->fetch_assoc();

if ($produkt && !empty($produkt['obrazek'])) {
    $plik = "uploads/" . $produkt['obrazek'];

    if (file_exists($plik)) {
        unlink($plik);
    }
}

$sql = "DELETE FROM produkty WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_produkty");
exit();