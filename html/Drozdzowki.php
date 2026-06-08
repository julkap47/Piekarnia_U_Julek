<!-- Menu kategorii -->
<section class="link-section">
    <p>
        <a href="Ciasta">Ciasta</a> |
        <a href="Ciasteczka">Ciasteczka</a> |
        <a href="Drozdzowki" class="active">Drożdżówki</a>
    </p>
</section>

<?php
$kategoria = "Drożdżówki";

$sql = "SELECT * FROM produkty WHERE kategoria = ? ORDER BY data_dodania DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kategoria);
$stmt->execute();
$produkty = $stmt->get_result();
?>

<section class="product-section">
    <div class="product-grid">

        <?php while ($produkt = $produkty->fetch_assoc()): ?>
            <article class="product">
                <img 
                    src="uploads/<?= htmlspecialchars($produkt['obrazek'] ?: 'brak-zdjecia.jpg') ?>" 
                    alt="<?= htmlspecialchars($produkt['nazwa']) ?>"
                >

                <div class="product-info">
                    <p class="product-name">
                        <?= htmlspecialchars($produkt['nazwa']) ?>
                    </p>

                    <details style="margin-top:10px; margin-bottom:10px;">
                        <summary style="
                            cursor:pointer;
                            display:inline-block;
                            padding:8px 15px;
                            background:#543A14;
                            color:white;
                            border-radius:5px;
                            font-weight:bold;
                            list-style:none;
                        ">
                            Skład
                        </summary>

                        <div style="
                            margin-top:10px;
                            padding:10px;
                            background:#f5f5f5;
                            border-radius:5px;
                            color:#333;
                            max-width:250px;
                        ">
                            <?= nl2br(htmlspecialchars($produkt['opis'])) ?>
                        </div>
                    </details>

                    <p class="product-price">
                        <?= htmlspecialchars($produkt['cena']) ?> zł
                    </p>
                </div>
            </article>
        <?php endwhile; ?>

    </div>
</section>