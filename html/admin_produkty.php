<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: landing_page");
    exit();
}

$produkty = $conn->query("SELECT * FROM produkty ORDER BY data_dodania DESC");
?>
<style>
    .add-btn{
        display: inline-block;
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        color: white !important;
        font-weight: bold;
        text-decoration: underline;
    }

</style>
<h1>Produkty</h1>

<a class="add-btn" href="admin_produkt_add">Dodaj produkt</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Zdjęcie</th>
        <th>Nazwa</th>
        <th>Kategoria</th>
        <th>Cena</th>
        <th>Skład</th>
        <th>Akcje</th>
    </tr>

    <?php while ($produkt = $produkty->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($produkt['id']) ?></td>

            <td>
                <?php if (!empty($produkt['obrazek'])): ?>
                    <img src="uploads/<?= htmlspecialchars($produkt['obrazek']) ?>" width="100">
                <?php else: ?>
                    Brak zdjęcia
                <?php endif; ?>
            </td>

            <td><?= htmlspecialchars($produkt['nazwa']) ?></td>
            <td><?= htmlspecialchars($produkt['kategoria']) ?></td>
            <td><?= htmlspecialchars($produkt['cena']) ?> zł</td>
            <td><?= nl2br(htmlspecialchars($produkt['opis'])) ?></td>
            <td>
                <a class="add-btn" href="admin_produkt_edit?id=<?= $produkt['id'] ?>">Edytuj</a>
                |
                <a class="add-btn" href="admin_produkt_delete?id=<?= $produkt['id'] ?>"
                onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?');">
                    Usuń
                </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>