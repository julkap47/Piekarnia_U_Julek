

   
<section>
        <!-- strzałki jakbyśmy chcieli zmmienić/dodać -->
        <div id="gallery"></div>
        <div class="image-container">
            <button class="arrow arrow-left" onclick="prevImage()">&#10094;</button>
            <div class="dots-container" id="dots-container"><div class="dot"></div></div>
            <button class="arrow arrow-right" onclick="nextImage()">&#10095;</button>
        </div>
        
    
</section>
<section>
    <div class="container">
        <div id="text-box">
            <h3>O nas</h3>
            <p>Piekarnia "U Julek" to miejscu, gdzie tradycja spotyka się z pasją do pieczenia! Nasza piekarnia to nie tylko miejsce, gdzie można kupić chleb i ciasta — to prawdziwa opowieść o rodzinnych recepturach, które są przekazywane z pokolenia na pokolenie.<br>
                    <br>
                Od wielu lat z dumą kontynuujemy tradycje piekarskie, które rozpoczęli nasi przodkowie. Każdy wypiek, który wychodzi z naszego pieca, jest wynikiem nie tylko doskonałej receptury, ale również miłości do sztuki pieczenia. Dzięki wykorzystaniu domowych przepisów oraz starannie dobranych składników, nasze produkty charakteryzują się wyjątkowym smakiem i jakością.
                <br></p>
            <a href="o nas">Zobacz więcej...</a>
        </div>
        <div id="image-box">
            <img src="img/piekarki.jpg" alt="Opis obrazka">
        </div>
    </div>
</section>
<section>
    <div class="order-container_2">
    <a href="Zamowienia" class="order-button-2">Zamów online</a>
</div>
    <script>
        const images = ["img/chlebek.jpg", "img/ciasto.jpg", "img/pszenna.jpg", "img/ciastko.jpg", "img/zytnia.jpg"];
let i = 0;

function addImage(){
    const gallery = document.getElementById("gallery");
    const img = new Image();
    img.setAttribute("src", images[i]);

    img.addEventListener('load', () =>{
        gallery.innerHTML = "";
        gallery.appendChild(img);
        updateDots(); // Aktualizuj kropeczki po załadowaniu obrazka
    });

    img.addEventListener('error', ()=>{
        gallery.innerHTML = "";
        const error = document.createElement('p');
        error.textContent = "Błąd wczytywania obrazka";
        gallery.appendChild(error);
    });
}

function prevImage() {
    i = (i - 1 + images.length) % images.length;
    addImage();
}

function nextImage() {
    i = (i + 1) % images.length;
    addImage();
}

function createDots() {
    const dotsContainer = document.getElementById('dots-container');
    dotsContainer.innerHTML = "";

    images.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'dot';
        if (index === i) dot.classList.add('active');

        dot.addEventListener('click', () => {
            i = index;
            addImage();
        });

        dotsContainer.appendChild(dot);
    });
}

function updateDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        if (index === i) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

createDots();
addImage();
setInterval(nextImage, 10000);
    </script>


</section>
