<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: logowanie");
    exit();
}

$user_id = (int)$_SESSION['user_id'];

$sql = "SELECT id, lokalizacja, produkty, kwota, status_zamowienia, data_zamowienia
        FROM zamowienia
        WHERE user_id = ?
        ORDER BY data_zamowienia DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h1>Moje zamówienia</h1>

<?php if ($result->num_rows === 0): ?>
    <p>Nie masz jeszcze żadnych zamówień.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Lokalizacja</th>
            <th>Produkty</th>
            <th>Kwota</th>
            <th>Status</th>
            <th>Data</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['lokalizacja']) ?></td>
                <td><?= htmlspecialchars($row['produkty']) ?></td>
                <td><?= htmlspecialchars($row['kwota']) ?> zł</td>
                <td><?= htmlspecialchars($row['status_zamowienia']) ?></td>
                <td><?= htmlspecialchars($row['data_zamowienia']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>