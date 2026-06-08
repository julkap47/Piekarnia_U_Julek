<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: index.php?page=landing_page");
    exit();
}

$kom = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nazwa = trim($_POST["nazwa"] ?? "");
    $kategoria = trim($_POST["kategoria"] ?? "");
    $cena = floatval($_POST["cena"] ?? 0);
    $opis = trim($_POST["opis"] ?? "");

    if ($nazwa !== "" && $kategoria !== "" && $cena > 0) {
        $sql = "INSERT INTO produkty (nazwa, kategoria, cena, opis)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $nazwa, $kategoria, $cena, $opis);
        $stmt->execute();

        header("Location: index.php?page=admin_produkty");
        exit();
    } else {
        $kom = "Uzupełnij nazwę, kategorię i cenę.";
    }
}
?>

<h1>Dodaj produkt</h1>

<?php if ($kom): ?>
    <p><?= htmlspecialchars($kom) ?></p>
<?php endif; ?>

<form method="POST" class="product-admin-form">
    <label>Nazwa produktu:</label>
    <input type="text" name="nazwa" required>

    <label>Kategoria:</label>
    <select name="kategoria" required>
        <option value="Chleby">Chleby</option>
        <option value="Bułki">Bułki</option>
        <option value="Ciasta">Ciasta</option>
        <option value="Ciasteczka">Ciasteczka</option>
        <option value="Drożdżówki">Drożdżówki</option>
    </select>

    <label>Cena:</label>
    <input type="number" name="cena" step="0.01" required>

    <label>Opis/skład:</label>
    <textarea name="opis"></textarea>

    <input type="submit" value="Dodaj produkt">
</form>