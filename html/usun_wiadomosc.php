<?php
$id = (int)($_GET["id"] ?? 0);

if ($id <= 0) {
    header("Location: admin&kom=Niepoprawne ID wiadomości.");
    exit();
}

$sql = "DELETE FROM wspolpraca WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin&kom=Wiadomość została usunięta.");
exit();
?>