<?php
if (!isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: landing_page");
    exit();
}

$kom = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nazwa = trim($_POST["nazwa"] ?? "");
    $kategoria = trim($_POST["kategoria"] ?? "");
    $cena = floatval($_POST["cena"] ?? 0);
    $opis = trim($_POST["opis"] ?? "");
    $obrazek = null;

    if ($nazwa !== "" && $kategoria !== "" && $cena > 0) {

        if (isset($_FILES["obrazek"]) && $_FILES["obrazek"]["error"] === 0) {
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
                $obrazek = uniqid("produkt_", true) . "." . $rozszerzenie;
                $sciezka = $folder . $obrazek;

                if (!move_uploaded_file($tmp, $sciezka)) {
                    $kom = "Błąd podczas przesyłania zdjęcia.";
                }
            }
        }

        if ($kom === "") {
            $sql = "INSERT INTO produkty (nazwa, kategoria, cena, opis, obrazek)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdss", $nazwa, $kategoria, $cena, $opis, $obrazek);
            $stmt->execute();

            header("Location: admin_produkty");
            exit();
        }

    } else {
        $kom = "Uzupełnij nazwę, kategorię i cenę.";
    }
}
?>

<h1>Dodaj produkt</h1>

<?php if ($kom): ?>
    <p><?= htmlspecialchars($kom) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="product-admin-form">
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

    <label>Zdjęcie produktu:</label>
    <input type="file" name="obrazek" accept="image/*">

    <label>Skład produktu:</label>
    <textarea name="opis"></textarea>

    <input type="submit" value="Dodaj produkt">
</form>