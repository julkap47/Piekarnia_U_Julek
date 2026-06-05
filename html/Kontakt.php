
   <?php
$komunikat = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $wiadomosc = trim($_POST["message"] ?? "");

    if ($email !== "" && $wiadomosc !== "") {
        $sql = "INSERT INTO wspolpraca (email, wiadomosc) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $wiadomosc);

        if ($stmt->execute()) {
            $komunikat = "Dziękujemy! Twoja wiadomość została zapisana.";
        } else {
            $komunikat = "Wystąpił błąd podczas zapisywania wiadomości.";
        }
    } else {
        $komunikat = "Uzupełnij wszystkie pola formularza.";
    }
}
?>
    <section class="godziny">
        <p>Pn - Pt - 7:00 - 19:00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>Sb - 8:00 - 15:00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p> Nd - zamknięte</p>
    </section>

    <section>
       

        <div class="container_lokale">
            
            <div id="text-box">
                <h3>Nasze lokale</h3>
                <div class="lokale">
                    <h4>Piekarnia u Julek - Stare Miasto</h4>
                    <p>Adres: ul. Floriańska 5, 31-019 Kraków<br>
                    Telefon: +48 123 456 789<br>
                    Email: staremiasto@piekarniaujulek.pl</p>
                </div>
                <div class="lokale">
                    <h4>Piekarnia u Julek - Kazimierz</h4>
                    <p>Adres: ul. Szeroka 10, 31-053 Kraków<br>
                    Telefon: +48 987 654 321<br>
                    Email: kazimierz@piekarniaujulek.pl</p>
                </div>
                <div class="lokale">
                    <h4>Piekarnia u Julek - Nowa Huta</h4>
                    <p>Adres: os. Centrum C 5, 31-931 Kraków<br>
                    Telefon: +48 321 654 987<br>
                    Email: nowahuta@piekarniaujulek.pl</p>
                </div>
            </div>
            <div class="kontener-mapy">
            <div id="map"></div>  
            </div>
        </div>
        
    </section>
   

    <section>
        <div id="FAQ-nagłówek"><h3 id="FAQ">FAQ</h3></div>
        <div class="FAQ">
    <div class="nagłówek"><p class="tytł">Jakie są godziny otwarcia Piekarni u Julek?</p><button class="hideButton">+</button></div>
    <p class="notatka">Nasze piekarnie są otwarte od poniedziałku do piątku w godzinach od 7:00 do 19:00, 
        a w soboty od 8:00 do 15:00. W niedziele jesteśmy zamknięci.
    </p>

    <div class="nagłówek"><p class="tytł">Czy piekarnia oferuje produkty bezglutenowe?</p><button class="hideButton">+</button></div>
    <p class="notatka">Tak, w naszej ofercie posiadamy również produkty bezglutenowe, które są przygotowywane z najwyższą starannością, 
        aby zapewnić bezpieczeństwo dla osób z nietolerancją glutenu.</p>

    <div class="nagłówek"><p class="tytł">Czy można zamówić produkty online?</p><button class="hideButton">+</button></div>
    <p class="notatka">Oczywiście! Oferujemy możliwość zamówienia naszych wyrobów przez naszą stronę internetową. 
        Wystarczy przejść do zakładki "Zamów online", wybrać produkty i złożyć zamówienie.</p>
        

    <div class="nagłówek"><p class="tytł">Czy piekarnia przyjmuje zamówienia na specjalne okazje?</p><button class="hideButton">+</button></div>
    <p class="notatka">Tak, przyjmujemy zamówienia na różnego rodzaju okazje, takie jak urodziny, wesela, czy inne imprezy okolicznościowe. 
        Prosimy o kontakt z nami z odpowiednim wyprzedzeniem, abyśmy mogli przygotować dla Państwa wyjątkowe wypieki.</p>
        </div>
    </section> 

    <section id="wspolpraca">
        <div class="container">
            <h3>Współpraca</h3>
            <p>Jesteśmy otwarci na różnego rodzaju współprace. Nasza piekarnia z chęcią podejmuje nowe wyzwania i aktywnie 
                poszukuje możliwości współpracy z innymi firmami, instytucjami oraz organizacjami. Jeśli prowadzisz restaurację, 
                kawiarnię, hotel lub inną działalność gastronomiczną i chciałbyś wprowadzić nasze wypieki do swojej oferty, 
                serdecznie zapraszamy do kontaktu. skontaktuj się z nami poprzez poniższy formularz.</p>
            <?php if (!empty($komunikat)): ?>
                <p style="color: green; font-weight: bold;">
                    <?php echo htmlspecialchars($komunikat); ?>
                </p>
            <?php endif; ?>
                <form id="contact-form" method="POST" action="">
                <label for="email">Twój adres email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Twoja wiadomość:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <button type="submit">Wyślij</button>
            </form>
        </div>
    </section>

     <script >
       
       $(document).ready(function() {
    $('.hideButton').on('click', function() {
        const $button = $(this); // Kliknięty przycisk
        const $note = $button.parent().next('.notatka'); // Znajduje powiązany element notatki

        $note.slideToggle("slow", function() {
            // Sprawdza widoczność tylko tej konkretnej notatki
            if ($note.is(':visible')) {
                $button.text('-');
            } else {
                $button.text('+');
            }
        });
    });
});


var map = L.map('map', {
    center: [50.06143, 19.93658], // Kraków jako centrum
    zoom: 10, // Początkowe przybliżenie
    minZoom: 12, // Minimalne przybliżenie
    maxBounds: [ // Granice mapy
        [49.9, 19.7], 
        [50.2, 20.2]  
    ]
});
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// punkty
L.marker([ 50.064167, 19.940833 ]).addTo(map)
    .bindPopup('Piekarnia u Julek - Stare Miasto<br>ul. Floriańska 5, 31-019 Kraków')
    .openPopup();
L.marker([50.052671, 19.948109]).addTo(map)
    .bindPopup('Piekarnia u Julek - Kazimierz<br>ul. Szeroka 10, 31-053 Kraków')
    .openPopup();
 L.marker([50.075154, 20.036950 ]).addTo(map)
    .bindPopup('Piekarnia u Julek - Nowa Huta<br>os. Centrum C 5, 31-931 Kraków')
    .openPopup();   




     </script>

