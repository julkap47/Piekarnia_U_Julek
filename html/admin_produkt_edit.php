<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: landing_page");
    exit();
}

$kom = "";
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: admin_produkty");
    exit();
}

$sql = "SELECT * FROM produkty WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Produkt nie istnieje.";
    exit();
}

$produkt = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nazwa = trim($_POST["nazwa"] ?? "");
    $kategoria = trim($_POST["kategoria"] ?? "");
    $cena = floatval($_POST["cena"] ?? 0);
    $opis = trim($_POST["opis"] ?? "");

    // TO JEST NAJWAŻNIEJSZE:
    // jeśli nie dodasz nowego zdjęcia, zostaje stare
    $obrazek = $produkt['obrazek'];

    if ($nazwa !== "" && $kategoria !== "" && $cena > 0) {

        if (
            isset($_FILES["obrazek"]) &&
            $_FILES["obrazek"]["error"] === UPLOAD_ERR_OK
        ) {
            $folder = "uploads/";

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $nazwaPliku = $_FILES["obrazek"]["name"];
            $tmp = $_FILES["obrazek"]["tmp_name"];
            $rozszerzenie = strtolower(pathinfo($nazwaPliku, PATHINFO_EXTENSION));

            $dozwolone = ["jpg", "jpeg", "png", "webp"];

            if (!in_array($rozszerzenie, $dozwolone)) {
                $kom = "Dozwolone formaty zdjęć: JPG, JPEG, PNG, WEBP.";
            } else {
                $nowyObrazek = uniqid("produkt_", true) . "." . $rozszerzenie;
                $sciezka = $folder . $nowyObrazek;

                if (move_uploaded_file($tmp, $sciezka)) {
                    $obrazek = $nowyObrazek;
                } else {
                    $kom = "Błąd podczas przesyłania zdjęcia.";
                }
            }
        }

        if ($kom === "") {
            $sql = "UPDATE produkty 
                    SET nazwa = ?, kategoria = ?, cena = ?, opis = ?, obrazek = ?
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdssi", $nazwa, $kategoria, $cena, $opis, $obrazek, $id);
            $stmt->execute();

            header("Location: admin_produkty");
            exit();
        }

    } else {
        $kom = "Uzupełnij nazwę, kategorię i cenę.";
    }
}
?>

<h1>Edytuj produkt</h1>

<?php if ($kom): ?>
    <p><?= htmlspecialchars($kom) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="product-admin-form">
    <label>Nazwa produktu:</label>
    <input type="text" name="nazwa" value="<?= htmlspecialchars($produkt['nazwa']) ?>" required>

    <label>Kategoria:</label>
    <select name="kategoria" required>
        <option value="Chleby" <?= $produkt['kategoria'] === 'Chleby' ? 'selected' : '' ?>>Chleby</option>
        <option value="Bułki" <?= $produkt['kategoria'] === 'Bułki' ? 'selected' : '' ?>>Bułki</option>
        <option value="Ciasta" <?= $produkt['kategoria'] === 'Ciasta' ? 'selected' : '' ?>>Ciasta</option>
        <option value="Ciasteczka" <?= $produkt['kategoria'] === 'Ciasteczka' ? 'selected' : '' ?>>Ciasteczka</option>
        <option value="Drożdżówki" <?= $produkt['kategoria'] === 'Drożdżówki' ? 'selected' : '' ?>>Drożdżówki</option>
    </select>

    <label>Cena:</label>
    <input type="number" name="cena" step="0.01" value="<?= htmlspecialchars($produkt['cena']) ?>" required>

    <label>Aktualne zdjęcie:</label>
    <?php if (!empty($produkt['obrazek'])): ?>
        <br>
        <img src="uploads/<?= htmlspecialchars($produkt['obrazek']) ?>" width="150">
        <br>
    <?php else: ?>
        <p>Brak zdjęcia</p>
    <?php endif; ?>

    <label>Zmień zdjęcie:</label>
    <input type="file" name="obrazek" accept="image/*">

    <label>Skład produktu:</label>
    <textarea name="opis"><?= htmlspecialchars($produkt['opis']) ?></textarea>

    <input type="submit" value="Zapisz zmiany">
</form>

<br>
<a href="admin_produkty">Wróć</a>