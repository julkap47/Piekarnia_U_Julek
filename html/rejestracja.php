<?php
require_once 'db_connect.php';

$kom = "";
$imie = "";
$nazwisko = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = trim($_POST['imie'] ?? '');
    $nazwisko = trim($_POST['nazwisko'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $haslo = trim($_POST['haslo'] ?? '');
    $haslo_pow = trim($_POST['haslo_pow'] ?? '');

    if ($imie === "" || $nazwisko === "" || $email === "" || $haslo === "" || $haslo_pow === "") {
        $kom = "Nie wszystkie pola są uzupełnione.";
    } elseif ($haslo !== $haslo_pow) {
        $kom = "Hasła nie są takie same.";
    } else {
        $hash = password_hash($haslo, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, pass, registration_date)
                VALUES (?, ?, ?, ?, NOW())";

        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $imie, $nazwisko, $email, $hash);
            $stmt->execute();

            $kom = "Rejestracja zakończyła się sukcesem!";

            $imie = "";
            $nazwisko = "";
            $email = "";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $kom = "Ten adres e-mail jest już zajęty!";
            } else {
                $kom = "Wystąpił problem z bazą danych. Spróbuj później.";
            }
        }
    }
}
?>

<div style="text-align: center;">
    <h1>Zarejestruj się</h1>

    <?php if (!empty($kom)): ?>
        <div class="komunikat <?php echo ($kom === 'Rejestracja zakończyła się sukcesem!') ? 'sukces' : 'blad'; ?>">
            <?php echo htmlspecialchars($kom); ?>
        </div><br>
    <?php endif; ?>
</div>

<form action="" method="POST">
    <label>Imię:</label><br><br>
    <input type="text" name="imie" placeholder="Imię" value="<?php echo htmlspecialchars($imie); ?>"><br><br>

    <label>Nazwisko:</label><br><br>
    <input type="text" name="nazwisko" placeholder="Nazwisko" value="<?php echo htmlspecialchars($nazwisko); ?>"><br><br>

    <label>Adres e-mail:</label><br><br>
    <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>"><br><br>

    <label>Hasło:</label><br><br>
    <input type="password" name="haslo" placeholder="Hasło"><br><br>

    <label>Powtórz hasło:</label><br><br>
    <input type="password" name="haslo_pow" placeholder="Powtórz hasło"><br><br>

    <input type="submit" value="Załóż konto"><br><br>
</form>