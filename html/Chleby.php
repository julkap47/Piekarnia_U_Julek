

    <!-- Dodaj linki na górze przed produktami -->
    <section class="link-section">
        <p><a href="Chleby">Chleby</a> | <a href="Bulki">Bułki</a> </p>
    </section>

    <section class="product-section">
        <div class="product-grid">
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb pszenny<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        
        
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb razowy<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        
        
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb IG<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb bez glutenu<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb z suszonymi pomidorami<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Chleb fitness<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">8 zł</p>
                </div>
            </article>
            <div id="sklad" class="sklad hidden">
                <div class="sklad-content">
                    <h2>Skład produktu</h2>
                    <p>Mąka, ser biały, cukier, drożdże, mleko...</p>
                    <button id="close" class="close">Zamknij</button>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        const skladCheckbox = document.getElementById('sklad-checkbox');
        const skladModal = document.getElementById('sklad');
        const closeModalButton = document.getElementById('close');

        // Obsługa kliknięcia na checkbox
        skladCheckbox.addEventListener('change', () => {
            if (skladCheckbox.checked) {
                skladModal.classList.remove('hidden'); // Pokaż okno
            }
        });

        // Obsługa kliknięcia na przycisk zamykający
        closeModalButton.addEventListener('click', () => {
            skladModal.classList.add('hidden'); 
            skladCheckbox.checked = false; 
        });
    </script>

