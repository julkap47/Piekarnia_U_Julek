

    <section>
        <div class="container">
            <div id="text-box">
                <h3>O nas</h3>
                <p>Piekarnia "U Julek" to miejscu, gdzie tradycja spotyka się z pasją do pieczenia! Nasza piekarnia to nie tylko miejsce, gdzie można kupić chleb i ciasta — to prawdziwa opowieść o rodzinnych recepturach, które są przekazywane z pokolenia na pokolenie.<br>
                    <br>
                    Od wielu lat z dumą kontynuujemy tradycje piekarskie, które rozpoczęli nasi przodkowie. Każdy wypiek, który wychodzi z naszego pieca, jest wynikiem nie tylko doskonałej receptury, ale również miłości do sztuki pieczenia. Dzięki wykorzystaniu domowych przepisów oraz starannie dobranych składników, nasze produkty charakteryzują się wyjątkowym smakiem i jakością.
                    <br><br>
                    W "U Julek" wierzymy, że chleb to coś więcej niż tylko jedzenie. To symbol domu, ciepła i wspólnoty. Codziennie pracujemy z dbałością o najdrobniejsze szczegóły, aby dostarczać naszym klientom pieczywo, które smakuje jak z kuchni babci.
                    <br><br>
                    Zapraszamy do naszej piekarni, aby poczuć zapach świeżo wypiekanego chleba i zasmakować w naszych wyjątkowych specjałach. Jesteśmy tutaj, aby podzielić się z Wami naszą pasją i tradycją!
                    
                    </p>
            
            </div>
            <div id="image-box">
                <img src="img/piekarki.jpg" alt="Opis obrazka">
            </div>
        </div>
    </section >
<div class="onas">
    <div class="nagłówek"><p class="tytł">Nasze wyroby pochodzą z naturalnych składników...</p><button class="hideButton">+</button></div>
    <p class="notatka">W Piekarni "U Julek" dbamy o to, aby każdy składnik naszych wypieków był najwyższej jakości 
        i pochodził z naturalnych źródeł.  Wybieramy tylko najlepsze mąki, świeże jaja, naturalne drożdże i lokalne owoce, 
        aby zapewnić naszym klientom zdrowe i smaczne produkty. Wierzymy, że prawdziwy smak chleba i ciast pochodzi z natury, 
        dlatego unikanie sztucznych dodatków to nasza dewiza.</p>

    <div class="nagłówek"><p class="tytł">Tradycja piekarska od pokoleń...</p><button class="hideButton">+</button></div>
    <p class="notatka">Historia naszej piekarni to opowieść o rodzinnych recepturach, które są przekazywane z pokolenia na 
        pokolenie. Od wielu lat z dumą kontynuujemy tradycje piekarskie zapoczątkowane przez naszych przodków. Każdy bochenek 
        chleba i każde ciasto to wynik starannie pielęgnowanych tajemniczych przepisów, które pozwalają nam tworzyć wypieki 
        o niepowtarzalnym smaku i aromacie.</p>

    <div class="nagłówek"><p class="tytł">Pieczywo jak z kuchni babci...</p><button class="hideButton">+</button></div>
    <p class="notatka">W "U Julek" wierzymy, że chleb to coś więcej niż tylko jedzenie – to symbol domu, ciepła i wspólnoty. 
        Nasze wypieki są przygotowywane z taką samą starannością i miłością, jaką wkładały nasze babcie w pieczenie chleba dla 
        swoich rodzin. Codziennie troszczymy się o najdrobniejsze szczegóły, aby dostarczać naszym klientom pieczywo, 
        które smakuje jak domowe.</p>
        

    <div class="nagłówek"><p class="tytł">Piekarnia w sercu miasta...</p><button class="hideButton">+</button></div>
    <p class="notatka">Piekarnia "U Julek" to trzy wyjątkowe lokalizacje w Krakowie – na Starym Mieście, Kazimierzu i 
        w Nowej Hucie. Nasza pierwsza piekarnia została założona na Starym Mieście, co czyni ją sercem naszej sieci i 
        miejscem, skąd wszystko się zaczęło. Każdy z naszych lokali oferuje niepowtarzalną atmosferę i zapach świeżo 
        wypiekanego chleba, który przyciąga mieszkańców i turystów. Nasze piekarnie to miejsca, gdzie można zatrzymać 
        się na chwilę, poczuć magię tradycji i zasmakować w wyjątkowych specjałach przygotowywanych z pasją.</p>
</div>  
        <section id="nasi-piekarze">
            <h3>Nasi piekarze</h3>
            <div class="piekarze-container">
                <div class="piekarz">
                    <h4>Julia P.</h4>
                    <img src="img/julkap.jpg" alt="Piekarz Julia P.">
                    <ul>
                        <li>Tworzenie szkieletu strony </li>
                        <li>Implementacja funkcjonalności strony</li>
                        <li>Testowanie i debugowanie strony</li>
                        <li>Implementacja wybranych podstron</li>
                    </ul>
                </div>
                <div class="piekarz">
                    <h4>Julia S.</h4>
                    <img src="img/julkas.jpg" alt="Piekarz Julia S.">
                    <ul>
                        <li>Przygotowanie koncepcji projektu strony</li>
                        <li>Projektowanie stylów CSS i elementów graficznych </li>
                        <li>Przygotowanie i optymalizacja treści oraz zdjęć</li>
                        <li>Implementacja wybranych podstron</li>
                    </ul>
                </div>
            </div>
        

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

     </script>
     </section>

