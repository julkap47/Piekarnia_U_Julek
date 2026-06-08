<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: index.php?page=landing_page");
    exit();
}

$produkty = $conn->query("SELECT * FROM produkty ORDER BY data_dodania DESC");
?>

<h1>Produkty</h1>

<a href="index.php?page=admin_produkt_add">Dodaj produkt</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nazwa</th>
        <th>Kategoria</th>
        <th>Cena</th>
        <th>Opis</th>
    </tr>

    <?php while ($produkt = $produkty->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($produkt['id']) ?></td>
            <td><?= htmlspecialchars($produkt['nazwa']) ?></td>
            <td><?= htmlspecialchars($produkt['kategoria']) ?></td>
            <td><?= htmlspecialchars($produkt['cena']) ?> zł</td>
            <td><?= htmlspecialchars($produkt['opis']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>