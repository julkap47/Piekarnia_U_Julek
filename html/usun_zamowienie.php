<?php
$id = (int)($_GET["id"] ?? 0);

if ($id <= 0) {
    header("Location: admin&kom=Niepoprawne ID zamówienia.");
    exit();
}

$sql = "DELETE FROM zamowienia WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin&kom=Zamówienie zostało usunięte.");
exit();
?>