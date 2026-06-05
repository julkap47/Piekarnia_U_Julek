    <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?></title>

    <link rel="stylesheet" href="styl/styl-all.css">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <?php
    if ($page === 'Chleby' || $page === 'Bulki' || $page === 'Drozdzowki' || $page === 'Ciasta' || $page === 'Ciasteczka') {
        echo '<link rel="stylesheet" href="styl/styl-produkty.css">';
    } elseif ($page === 'landing_page') {
        echo '<link rel="stylesheet" href="styl/styl-landingpage.css">';
    } elseif ($page === 'odbior-osobity') {
        echo '<link rel="stylesheet" href="styl/odbior-osobisty.css">';
    } elseif ($page === 'Kontakt') {
    echo '<link rel="stylesheet" href="styl/styl-zakladki-kontakt.css">';
    echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
    echo '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>';
    } elseif ($page === 'Zamowienia') {
        echo '<link rel="stylesheet" href="styl/styl-zakladki-zamowienia.css">';
    } elseif ($page === 'o_nas') {
        echo '<link rel="stylesheet" href="styl/styl-zakladki-onas.css">';
        echo  '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
    }
    ?>
</head>
<body>
    <header>
        <h3>Piekarnia u Julek</h3>
    </header>

    <nav class="menu_bar">
        <div class="logo-container">
            <img src="img/logo.png" alt="Logo Piekarni" class="logo">
        </div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <div class="menu-links">
            <a href="landing_page"><img src="img/start.png" alt="Start" class="Start"></a>
            <a href="o_nas">O nas</a>
            <a href="Drozdzowki">Wyroby Cukiernicze</a>
            <a href="Chleby" class="active">Wyroby Piekarnicze</a>
            <a href="Kontakt">Kontakt</a>
            <div class="order-wrapper">
                <div class="order-container">
                    <a href="Zamowienia" class="order-button">Zamów online</a>
                </div>
            </div>
        </div>
    </nav>
