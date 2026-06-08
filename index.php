<?php
    session_start();
    require_once 'db_connect.php';
?>
<?php 
$page = $_GET["page"] ?? 'landing_page';

switch( $page ){
    case 'landing_page': 
        $pageTitle = 'Strona Główna - Piekarnia u Julek';
        break;
    case 'Bulki': 
        $pageTitle = "Bułki - Piekarnia u Julek";
        break;
    case 'Chleby':
        $pageTitle = 'Chleby - Piekarnia u Julek';
        break;
    case 'Ciasta':
        $pageTitle = "Ciasta - Piekarnia u Julek";
        break;
    case 'Ciasteczka':
        $pageTitle = "Ciasteczka - Piekarnia u Julek";
        break;  
    case 'Drozdzowki':
        $pageTitle = "Drożdżówki - Piekarnia u Julek";
        break;  
    case 'o_nas':
        $pageTitle = "O nas - Piekarnia u Julek";
        break;  
    case 'Kontakt':
        $pageTitle = "Kontakt - Piekarnia u Julek";
        break;
    case 'Zamowienia':
        $pageTitle = "Zamówienia online - Piekarnia u Julek";
        break;
    case 'regulamin':
        $pageTitle = "Regulamin zamówień online - Piekarnia u Julek";
        break;
    case 'odbior-osobity':
        $pageTitle = "Odbiór osobisty - Piekarnia u Julek";
        break;
    case 'polityka_prywatnosci':
        $pageTitle = "Polityka prywatności - Piekarnia u Julek";
        break;  
    case 'admin':
        $pageTitle="Panel administratora - Piekarnia u Julek";
        break;
    case 'usun_zamowienie':
        $pageTitle = "Usuń zamówienie - Piekarnia u Julek";
        break;

    case 'usun_wiadomosc':
        $pageTitle = "Usuń wiadomość - Piekarnia u Julek";
        break;
    case 'logowanie':
        $pageTitle = "Logowanie użytkownika - Piekarnia u Julek";
        break;
    case 'rejestracja':
        $pageTitle = "Rejestracja użytkownika - Piekarnia u Julek";
        break;
    case 'logout':
        $pageTitle = "Wyloguj się - Piekarnia u Julek";
        break;
    case 'users':
        $pageTitle = "Użytkownicy - Piekarnia u Julek";
        break;
    case 'admin_user_add':
        $pageTitle = "Dodawanie użytkownika przez admina - Piekarnia u Julek";
        break;
    case 'admin_user_edit':
         $pageTitle = "Edytowanie użytkownika przez admina - Piekarnia u Julek";
        break;
    case 'admin_user_delete':
         $pageTitle = "Usuwanie użytkownika przez admina - Piekarnia u Julek";
        break;
    case 'admin_produkty':
        $pageTitle = "Produkty - Panel admina";
        break;

    case 'admin_produkt_add':
        $pageTitle = "Dodaj produkt";
        break;
    case 'moje_zamowienia':
        $pageTitle = "Moje zamówienia - Piekarnia u Julek";
        break;
    case 'status_zamowienia':
        $pageTitle = "Zmiana statusu zamówienia - Piekarnia u Julek";
        break;
    
    default:
        $pageTitle = "404 - Strona nie odneloziona";

}

$filePath = 'html/' .$page .".php" ;

if (!file_exists($filePath)) {
    $filePath = null;
}
include 'header.php';
?>

<main>
    <?php
if($filePath){
    include $filePath;
}else {
    echo "<h1>Błąd 404</h1><p>Strona o podanym adresie nie istnieje </p>";
}
?>
</main>
<?php
include 'footer.php';
?>