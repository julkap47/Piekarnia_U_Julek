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
<style>
    h1 {
        text-align: center;
        margin: 30px 0;
        color: #F3E9DC;
    }

    .product-admin-form {
        width: 500px;
        max-width: 90%;
        margin: 30px auto;
        padding: 30px;
        background-color: #F3E9DC;
        color: #161b1d;
        border-radius: 12px;
        box-sizing: border-box;
    }

    .product-admin-form label {
        display: block;
        margin-top: 15px;
        margin-bottom: 6px;
        font-weight: bold;
    }

    .product-admin-form input,
    .product-admin-form select,
    .product-admin-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #876245;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
        font-family: inherit;
    }

    .product-admin-form textarea {
        min-height: 120px;
        resize: vertical;
    }

    .product-admin-form input[type="submit"] {
        margin-top: 25px;
        background-color: #876245;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .product-admin-form input[type="submit"]:hover {
        background-color: #543A14;
    }

    .komunikat {
        width: 500px;
        max-width: 90%;
        margin: 20px auto;
        padding: 12px;
        background-color: #c0392b;
        color: white;
        border-radius: 6px;
        text-align: center;
    }
</style>
<h1>Dodaj produkt</h1>

<?php if ($kom): ?>
    <p class="komunikat"><?= htmlspecialchars($kom) ?></p>
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
    <br>

    <label>Cena:</label>
    <input type="number" name="cena" step="0.01" required>

    <label>Zdjęcie produktu:</label>
    <input type="file" name="obrazek" accept="image/*">

    <label>Skład produktu:</label>
    <textarea name="opis"></textarea>

    <input type="submit" value="Dodaj produkt">
</form>