<?php
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: index.php?page=landing_page");
    exit();
}

$kom = $_GET['kom'] ?? "";

$sql = "SELECT user_id, first_name, last_name, email, role,registration_date
        FROM users 
        ORDER BY last_name ASC";

$result = $conn->query($sql);
?>

<?php
$kom = $_GET["kom"] ?? "";

$zamowienia = $conn->query("
    SELECT id, imie_nazwisko, email, telefon, lokalizacja, produkty, kwota, status_zamowienia,data_zamowienia
    FROM zamowienia
    ORDER BY data_zamowienia DESC
");

$wiadomosci = $conn->query("
    SELECT id, email, wiadomosc, data_wyslania
    FROM wspolpraca
    ORDER BY data_wyslania DESC
");
?>

<h1>Panel administratora</h1>

<?php if (!empty($kom)): ?>
    <div class="komunikat">
        <?php echo htmlspecialchars($kom); ?>
    </div>
<?php endif; ?>

<h2>Zamówienia</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Klient</th>
        <th>Email</th>
        <th>Telefon</th>
        <th>Lokalizacja</th>
        <th>Produkty</th>
        <th>Kwota</th>
        <th>Status</th>
        <th>Data</th>
        <th>Akcje</th>
    </tr>

    <?php while ($row = $zamowienia->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["imie_nazwisko"]); ?></td>
            <td><?php echo htmlspecialchars($row["email"]); ?></td>
            <td><?php echo htmlspecialchars($row["telefon"]); ?></td>
            <td><?php echo htmlspecialchars($row["lokalizacja"]); ?></td>
            <td><?php echo htmlspecialchars($row["produkty"]); ?></td>
            <td><?php echo htmlspecialchars($row["kwota"]); ?> zł</td>
            <td><?php echo htmlspecialchars($row["status_zamowienia"]); ?></td>
            <td><?php echo htmlspecialchars($row["data_zamowienia"]); ?></td>
            <td>

    <a href="status_zamowienia&id=<?php echo $row['id']; ?>&status=<?php echo urlencode('Przyjęte do realizacji'); ?>">
    Przyjęte
</a>

|

<a href="status_zamowienia&id=<?php echo $row['id']; ?>&status=<?php echo urlencode('Gotowe do odbioru'); ?>">
    Gotowe
</a>

|

<a href="status_zamowienia&id=<?php echo $row['id']; ?>&status=<?php echo urlencode('Odebrane'); ?>">
    Odebrane
</a>
<a href="status_zamowienia&id=<?php echo $row['id']; ?>&status=<?php echo urlencode('Usuń'); ?>">
    Usuń
</a>

</td>
        </tr>
    <?php endwhile; ?>
</table>

<br><br>

<h2>Wiadomości współpracy</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Wiadomość</th>
        <th>Data</th>
        <th>Akcje</th>
    </tr>

    <?php while ($row = $wiadomosci->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["email"]); ?></td>
            <td><?php echo htmlspecialchars($row["wiadomosc"]); ?></td>
            <td><?php echo htmlspecialchars($row["data_wyslania"]); ?></td>
            <td>
                <a href="usun_wiadomosc&id=<?php echo $row["id"]; ?>"
                   onclick="return confirm('Czy na pewno usunąć tę wiadomość?');">
                    Usuń
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<h2>Użytkownicy</h2>

<div class="admin-actions">
    <a href="admin_user_add">Dodaj użytkownika</a>
    <a href="admin_produkty">Zarządzaj produktami</a>
</div>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Rola</th>
        <th>Data rejestracji</th>
        <th>Akcje</th>
    </tr>

    <?php while ($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['user_id']); ?></td>
            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <?php echo ((int)$user['role'] === 1) ? "Administrator" : "Użytkownik"; ?>
            </td>
            <td><?php echo htmlspecialchars($user['registration_date']); ?></td>
            <td>
                <a href="admin_user_edit&id=<?php echo $user['user_id']; ?>">Edytuj</a>
                |
                <a href="admin_user_delete&id=<?php echo $user['user_id']; ?>"
                   onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                   Usuń
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>