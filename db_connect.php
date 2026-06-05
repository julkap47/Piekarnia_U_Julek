<?php
$conn=mysqli_connect("localhost","root","","piekarnia_db");
mysqli_set_charset($conn,"utf8mb4");
if(!$conn){
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
?>