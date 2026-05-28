

    <!-- Dodaj linki na górze przed produktami -->
    <section class="link-section">
        <p><a href="Drozdzowki">Drożdżówki</a> | <a href="Ciasta">Ciasta</a> | <a href="Ciasteczka">Ciasteczka</a></p>
    </section>

    <section class="product-section">
        <div class="product-grid">
            <!-- Produkty -->
            <article class="product">
                <img src="img/zdj1.jpg" alt="Drożdżówka z serem">
                <div class="product-info">
                    <p class="product-name">Brownie<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
                    <p class="product-name">Tiramisu<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
                    <p class="product-name">Makowiec<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
                    <p class="product-name">Sernik<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
                    <p class="product-name">Piernik<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
                    <p class="product-name">Szarlotka<br>
                        <label for="sklad-checkbox" class="sklad-label">Skład</label>
                        <input type="checkbox" id="sklad-checkbox" class="sklad" style="display: none;">
                    </p>        
                    <p class="product-price">30 zł</p>
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
