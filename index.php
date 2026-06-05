<?php
    session_start();
    require_once 'db_connect.php';
?>
<?php 
$page = $_GET["page"] ?? 'landing_page';

switch( $page ){
    case 'landing_page': 
        $pageTitle = 'Strona Główna - Piekatnia u Julek';
        break;
    case 'Bulki': 
        $pageTitle = "Bułki - Piekatnia u Julek";
        break;
    case 'Chleby':
        $pageTitle = 'Chleby - Piekatnia u Julek';
        break;
    case 'Ciasta':
        $pageTitle = "Ciasta - Piekatnia u Julek";
        break;
    case 'Ciasteczka':
        $pageTitle = "Ciasteczka - Piekatnia u Julek";
        break;  
    case 'Drozdzowki':
        $pageTitle = "Drożdżówki - Piekatnia u Julek";
        break;  
    case 'o_nas':
        $pageTitle = "O nas - Piekatnia u Julek";
        break;  
    case 'Kontakt':
        $pageTitle = "Kontakt - Piekatnia u Julek";
        break;
    case 'Zamowienia':
        $pageTitle = "Zamówienia online - Piekatnia u Julek";
        break;
    case 'regulamin':
        $pageTitle = "Regulamin zamówień online - Piekatnia u Julek";
        break;
    case 'odbior-osobity':
        $pageTitle = "Odbiór osobisty - Piekatnia u Julek";
        break;
    case 'polityka-prywatnosci':
        $pageTitle = "Polityka prywatności - Piekatnia u Julek";
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