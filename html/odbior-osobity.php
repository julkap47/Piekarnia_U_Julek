

    <main>
        <form id="order-form">
            <!-- Wybór lokalizacji -->
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

            <!-- Dane klienta -->
            <fieldset>
                <legend>Twoje dane:</legend>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Adres e-mail:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Numer telefonu:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{9}" required>
            </fieldset>

            <!-- Produkty -->
            <fieldset>
                <legend>Dodaj produkty:</legend>
                <div id="product-list">
                    <div class="product-item">
                        <ul id="lista"></ul>
                        <label for="product-1">Produkt:</label>
                        <select id="product-1" name="products[]" >
                            <option value="" disabled selected>Wybierz produkt</option>
                            <option value="Drożdżówka">Drożdżówka z serem - 5 PLN</option>
                            <option value="Drożdżówka">Drożdżówka z marmoladą - 5 PLN</option>
                            <option value="Drożdżówka">Drożdżówka z czekoladą - 5 PLN</option>
                            <option value="Drożdżówka">Drożdżówka z czekoladą - 5 PLN</option>
                            <option value="Drożdżówka">Drożdżówka z budyniem - 5 PLN</option>
                            <option value="Drożdżówka">Drożdżówka z kruszonką - 5 PLN</option>
                            <option value="Ciasta">Brownie - 30 PLN</option>
                            <option value="Ciasta">Tiramisu - 30 PLN</option>
                            <option value="Ciasta">Makowiec - 30 PLN</option>
                            <option value="Ciasta">Sernik - 30 PLN</option>
                            <option value="Ciasta">Piernik - 30 PLN</option>
                            <option value="Ciasta">Szarlotka - 30 PLN</option>
                            <option value="Ciasteczka">Chocolate chip - 3 PLN</option>
                            <option value="Ciasteczka">Owsiane z rodzynkami - 3 PLN</option>
                            <option value="Ciasteczka">Maślane - 3 PLN</option>
                            <option value="Ciasteczka">Snickerdoodles - 3 PLN</option>
                            <option value="Ciasteczka">Pierniczki - 3 PLN</option>
                            <option value="Ciasteczka">Makaroniki - 3 PLN</option>
                            <option value="Chleb">Chleb pszenny - 8 PLN</option>
                            <option value="Chleb">Chleb razowy - 8 PLN</option>
                            <option value="Chleb">Chleb IG - 8 PLN</option>
                            <option value="Chleb">Chleb bez glutenu - 8 PLN</option>
                            <option value="Chleb">Chleb z suszonymi pomidorami - 8 PLN</option>
                            <option value="Chleb">Chleb fitness - 8 PLN</option>
                            <option value="Bułka">Bułka pszenna - 2 PLN</option>
                            <option value="Bułka">Bułka razowa - 2 PLN</option>
                            <option value="Bułka">Bułka z serem - 2 PLN</option>
                            <option value="Bułka">Bułka bez glutenu - 2 PLN</option>
                            <option value="Bułka">Bułka fitness - 2 PLN</option>
                            <option value="Bułka">Bułka z pestkami dyni - 2 PLN</option>
                        </select>
                        <label for="quantity-1">Ilość:</label>
                        <input type="number" id="quantity-1" name="quantities[]" min="1" value="1" required>
                    </div>
                </div>
                <button type="button" id="add-product">Dodaj kolejny produkt</button>
            </fieldset>

            <!-- Zgody -->
            <fieldset>
                <legend>Zgody:</legend>
                <div class="zgody">
                    <label>
                        Akceptuję&nbsp;<a href="regulamin" target="_blank">regulamin</a> &nbsp;składania zamówień.
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
            <button type="button" id="summary-button">Podsumowanie</button>


            <button type="submit">Złóż zamówienie</button>

            
        <div id="email-sent-message" class="hidden">Dziękujemy za zamówienie! Podsumowanie zamówienia zostało wysłane na Twój e-mail.</div>

        </form>
            <!-- Podsumowanie i wysyłka -->

            <!-- Ukryte podsumowanie -->
            <div id="summary" class="summary hidden">
                <div id="summary-content"></div>
                <button id="close" class="close">Zamknij</button>
            </div>
            
        
    
    </main>
</body>

        
     <script >


$(document).ready(function () {
    // Dodawanie produktu do listy
    $('#add-product').on('click', function () {
        const selectedProduct = $('#product-1 option:selected').text(); // Pobranie wybranego produktu
        const quantity = $('#quantity-1').val(); // Pobranie ilości
        if (selectedProduct && quantity > 0) {
            $('#lista').append(`<li>${quantity} x ${selectedProduct} <button class="remove-item">Usuń</button></li>`);
            // Resetowanie pól
            $('#product-1').val('');
            $('#quantity-1').val('1');
        } else {
            alert('Wybierz produkt i podaj ilość!');
        }
    });

    // Usuwanie produktu z listy
    $('#lista').on('click', '.remove-item', function () {
        $(this).closest('li').remove(); // Usuwa rodzica (element li)
    });

    // Wyświetlanie podsumowania
    $('#summary-button').on('click', function () {
        let summaryHTML = '<h2>Podsumowanie zamówienia:</h2><ul>';

        // Pobranie wybranej lokalizacji
        const location = $("input[name='location']:checked").val();
        summaryHTML += `<li><strong>Lokalizacja:</strong> ${location || 'Nie wybrano'}</li>`;

        // Pobranie danych klienta
        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        summaryHTML += `<li><strong>Imię i nazwisko:</strong> ${name || 'Nie podano'}</li>`;
        summaryHTML += `<li><strong>Email:</strong> ${email || 'Nie podano'}</li>`;
        summaryHTML += `<li><strong>Telefon:</strong> ${phone || 'Nie podano'}</li>`;

        // Pobranie produktów i ilości z listy
        const productItems = $('#lista li');
        let total = 0;

        productItems.each(function () {
            const itemText = $(this).text();
            const quantity = parseInt(itemText.split(' x ')[0]);
            const productName = itemText.split(' x ')[1].split(' - ')[0];
            const price = parseFloat(itemText.split(' - ')[1].replace(' PLN', ''));
            total += price * quantity;
            summaryHTML += `<li><strong>Produkt:</strong> ${productName} <strong>Ilość:</strong> ${quantity}</li>`;
        });

        // Zgody
        const terms = $("input[name='terms']").is(":checked") ? "Tak" : "Nie";
        const privacy = $("input[name='privacy']").is(":checked") ? "Tak" : "Nie";
        const marketing = $("input[name='marketing']").is(":checked") ? "Tak" : "Nie";
        summaryHTML += `<li><strong>Regulamin:</strong> ${terms}</li>`;
        summaryHTML += `<li><strong>Polityka prywatności:</strong> ${privacy}</li>`;
        summaryHTML += `<li><strong>Wiadomości marketingowe:</strong> ${marketing}</li>`;

        // Łączna kwota
        summaryHTML += `<li class="total-price"><strong>Łączna kwota:</strong> ${total.toFixed(2)} PLN</li>`;

        // Zakończenie podsumowania
        summaryHTML += '</ul>';

        // Wstawienie podsumowania do modal
        $('#summary-content').html(summaryHTML);

        // Pokaż modal
        $('#summary').addClass('show');
    });
    // Zamknięcie podsumowania
    $('#close').on('click', function () {
        $('#summary').removeClass('show');
    });
    

   // Obsługa przycisku "Złóż zamówienie"
$('#order-form').on('submit', function (event) {
    event.preventDefault(); 
    // Sprawdzenie, czy lista produktów nie jest pusta
    if ($('#lista li').length === 0) {
        alert('Musisz dodać przynajmniej jeden produkt do zamówienia.');
        return;
    }

    // Pokaż komunikat o wysłaniu na e-mail
    const emailMessage = $('#email-sent-message');
    emailMessage.removeClass('hidden').addClass('show'); // Dodaj klasę, aby komunikat się pojawił

    // Ukryj komunikat po 3 sekundach
    setTimeout(function () {
        emailMessage.removeClass('show').addClass('hidden');
    }, 4000);

    this.reset(); // Resetuje wszystkie pola formularza
    $('#lista').empty(); 
    // Możesz dodać logikę do wysłania formularza tutaj
    // this.submit(); // Wyślij formularz, jeśli ma to być prawdziwe wysyłanie
});

});
        </script>
