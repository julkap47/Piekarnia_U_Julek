<?php
$komunikat = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lokalizacja = $_POST["location"] ?? "";
    $imie = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefon = trim($_POST["phone"] ?? "");
    $produkty = $_POST["produkty_lista"] ?? "";
    $kwota = floatval($_POST["kwota"] ?? 0);

    if ($lokalizacja && $imie && $email && $telefon && $produkty) {
       $user_id = $_SESSION['user_id'] ?? null;

    $user_id = $_SESSION['user_id'] ?? null;

$sql = "INSERT INTO zamowienia 
        (user_id, imie_nazwisko, email, telefon, lokalizacja, produkty, kwota)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "isssssd",
    $user_id,
    $imie,
    $email,
    $telefon,
    $lokalizacja,
    $produkty,
    $kwota
);

if ($stmt->execute()) {
    $komunikat = "Dziękujemy za zamówienie! Zamówienie zostało zapisane.";
} else {
    $komunikat = "Wystąpił błąd podczas zapisywania zamówienia.";
}
    } else {
        $komunikat = "Uzupełnij wszystkie wymagane pola i dodaj produkt.";
    }
}
?>

<?php if (!empty($komunikat)): ?>
    <div id="email-sent-message" class="show">
        <?php echo htmlspecialchars($komunikat); ?>
    </div>
<?php endif; ?>

<form id="order-form" method="POST" action="">
    <fieldset>
        <legend>Wybierz lokalizację:</legend>
        <div class="lokalizacja">
            <label>
                <input type="radio" name="location" value="Stare Miasto" required>
                Piekarnia u Julek - Stare Miasto
            </label>
            <label>
                <input type="radio" name="location" value="Kazimierz">
                Piekarnia u Julek - Kazimierz
            </label>
            <label>
                <input type="radio" name="location" value="Nowa Huta">
                Piekarnia u Julek - Nowa Huta
            </label>
        </div>
    </fieldset>

    <fieldset>
        <legend>Twoje dane:</legend>

        <label for="name">Imię i nazwisko:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Numer telefonu:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{9}" required>
    </fieldset>

    <fieldset>
        <legend>Dodaj produkty:</legend>

        <div id="product-list">
            <div class="product-item">
                <ul id="lista"></ul>

                <label for="product-1">Produkt:</label>
                <select id="product-1">
                    <option value="" disabled selected>Wybierz produkt</option>

                    <option>Drożdżówka z serem - 5 PLN</option>
                    <option>Drożdżówka z marmoladą - 5 PLN</option>
                    <option>Drożdżówka z czekoladą - 5 PLN</option>
                    <option>Drożdżówka z budyniem - 5 PLN</option>
                    <option>Drożdżówka z kruszonką - 5 PLN</option>

                    <option>Brownie - 30 PLN</option>
                    <option>Tiramisu - 30 PLN</option>
                    <option>Makowiec - 30 PLN</option>
                    <option>Sernik - 30 PLN</option>
                    <option>Piernik - 30 PLN</option>
                    <option>Szarlotka - 30 PLN</option>

                    <option>Chocolate chip - 3 PLN</option>
                    <option>Owsiane z rodzynkami - 3 PLN</option>
                    <option>Maślane - 3 PLN</option>
                    <option>Snickerdoodles - 3 PLN</option>
                    <option>Pierniczki - 3 PLN</option>
                    <option>Makaroniki - 3 PLN</option>

                    <option>Chleb pszenny - 8 PLN</option>
                    <option>Chleb razowy - 8 PLN</option>
                    <option>Chleb IG - 8 PLN</option>
                    <option>Chleb bez glutenu - 8 PLN</option>
                    <option>Chleb z suszonymi pomidorami - 8 PLN</option>
                    <option>Chleb fitness - 8 PLN</option>

                    <option>Bułka pszenna - 2 PLN</option>
                    <option>Bułka razowa - 2 PLN</option>
                    <option>Bułka z serem - 2 PLN</option>
                    <option>Bułka bez glutenu - 2 PLN</option>
                    <option>Bułka fitness - 2 PLN</option>
                    <option>Bułka z pestkami dyni - 2 PLN</option>
                </select>

                <label for="quantity-1">Ilość:</label>
                <input type="number" id="quantity-1" min="1" value="1" required>
            </div>
        </div>

        <button type="button" id="add-product">Dodaj kolejny produkt</button>
    </fieldset>

    <fieldset>
        <legend>Zgody:</legend>

        <div class="zgody">
            <label>
                Akceptuję&nbsp;<a href="regulamin" target="_blank">regulamin</a>&nbsp;składania zamówień.
                <input type="checkbox" name="terms" required>
            </label>

            <label>
                Akceptuję&nbsp;<a href="polityka_prywatnosci" target="_blank">politykę prywatności</a>.
                <input type="checkbox" name="privacy" required>
            </label>

            <label>
                Chcę otrzymywać wiadomości marketingowe.
                <input type="checkbox" name="marketing">
            </label>
        </div>
    </fieldset>

    <input type="hidden" name="produkty_lista" id="produkty_lista">
    <input type="hidden" name="kwota" id="kwota">

    <button type="button" id="summary-button">Podsumowanie</button>
    <button type="submit">Złóż zamówienie</button>
</form>

<div id="summary" class="summary hidden">
    <div id="summary-content"></div>
    <button id="close" class="close">Zamknij</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const addProductButton = document.getElementById("add-product");
    const productSelect = document.getElementById("product-1");
    const quantityInput = document.getElementById("quantity-1"); 
    const lista = document.getElementById("lista");
    const summaryButton = document.getElementById("summary-button");
    const summary = document.getElementById("summary");
    const summaryContent = document.getElementById("summary-content");
    const closeButton = document.getElementById("close");
    const orderForm = document.getElementById("order-form");
    const produktyListaInput = document.getElementById("produkty_lista");
    const kwotaInput = document.getElementById("kwota");

    addProductButton.addEventListener("click", function () {
        const selectedProduct = productSelect.options[productSelect.selectedIndex].text;
        const quantity = quantityInput.value;

        if (productSelect.value !== "" && quantity > 0) {
            const li = document.createElement("li");
            li.dataset.product = selectedProduct;
            li.dataset.quantity = quantity;

            li.innerHTML = `${quantity} x ${selectedProduct} <button type="button" class="remove-item">Usuń</button>`;
            lista.appendChild(li);

            productSelect.selectedIndex = 0;
            quantityInput.value = 1;
        } else {
            alert("Wybierz produkt i podaj ilość!");
        }
    });

    lista.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-item")) {
            event.target.closest("li").remove();
        }
    });

    function obliczZamowienie() {
        const productItems = lista.querySelectorAll("li");
        let total = 0;
        let produktyLista = "";
        let produktyHTML = "";

        productItems.forEach(function (item) {
            const quantity = parseInt(item.dataset.quantity);
            const productText = item.dataset.product;

            const productName = productText.split(" - ")[0];
            const price = parseFloat(productText.split(" - ")[1].replace(" PLN", ""));

            total += quantity * price;
            produktyLista += `${quantity} x ${productName} - ${price} PLN; `;
            produktyHTML += `<li><strong>Produkt:</strong> ${productName} <strong>Ilość:</strong> ${quantity}</li>`;
        });

        return {
            total: total,
            produktyLista: produktyLista,
            produktyHTML: produktyHTML
        };
    }

    summaryButton.addEventListener("click", function () {
        const location = document.querySelector("input[name='location']:checked")?.value;
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;

        const wynik = obliczZamowienie();

        let summaryHTML = "<h2>Podsumowanie zamówienia:</h2><ul>";
        summaryHTML += `<li><strong>Lokalizacja:</strong> ${location || "Nie wybrano"}</li>`;
        summaryHTML += `<li><strong>Imię i nazwisko:</strong> ${name || "Nie podano"}</li>`;
        summaryHTML += `<li><strong>Email:</strong> ${email || "Nie podano"}</li>`;
        summaryHTML += `<li><strong>Telefon:</strong> ${phone || "Nie podano"}</li>`;
        summaryHTML += wynik.produktyHTML;

        const terms = document.querySelector("input[name='terms']").checked ? "Tak" : "Nie";
        const privacy = document.querySelector("input[name='privacy']").checked ? "Tak" : "Nie";
        const marketing = document.querySelector("input[name='marketing']").checked ? "Tak" : "Nie";

        summaryHTML += `<li><strong>Regulamin:</strong> ${terms}</li>`;
        summaryHTML += `<li><strong>Polityka prywatności:</strong> ${privacy}</li>`;
        summaryHTML += `<li><strong>Wiadomości marketingowe:</strong> ${marketing}</li>`;
        summaryHTML += `<li class="total-price"><strong>Łączna kwota:</strong> ${wynik.total.toFixed(2)} PLN</li>`;
        summaryHTML += "</ul>";

        summaryContent.innerHTML = summaryHTML;
        summary.classList.remove("hidden");
        summary.classList.add("show");
    });

    closeButton.addEventListener("click", function () {
        summary.classList.remove("show");
        summary.classList.add("hidden");
    });

    orderForm.addEventListener("submit", function (event) {
        if (lista.querySelectorAll("li").length === 0) {
            event.preventDefault();
            alert("Musisz dodać przynajmniej jeden produkt do zamówienia.");
            return;
        }

        const wynik = obliczZamowienie();

        produktyListaInput.value = wynik.produktyLista;
        kwotaInput.value = wynik.total.toFixed(2);
    });
});
</script>