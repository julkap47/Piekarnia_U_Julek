<?php
require_once 'db_connect.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: home");
    exit();
}
$kom = "";
$imie = "";
$nazwisko = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = trim($_POST['imie'] ?? '');
    $nazwisko = trim($_POST['nazwisko'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $haslo = trim($_POST['haslo'] ?? '');
    $rola=(int)($_POST['rola'] ?? 0 );
    if ($rola !== 0 && $rola !== 1) {
        $rola = 0;
    }
    if ($imie === "" || $nazwisko === "" || $email === "" || $haslo === "" ) {
        $kom = "Nie wszystkie pola są uzupełnione.";
    }else {
        $hash = password_hash($haslo, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, email, pass, registration_date, role)
                VALUES (?, ?, ?, ?, NOW(),?)";

        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $imie, $nazwisko, $email, $hash, $rola);
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
<style>
    .stat-btn {
    display: inline-block;
    background: #876245;
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 6px;
    margin-right: 10px;
    transition: 0.3s;
}

    .stat-btn:hover {
    background: #7e663f;
}
    .sub{
    display: inline-block;
    background: #876245;
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 6px;
    margin-right: 10px;
    transition: 0.3s;
    }

</style>
<h1>Dodaj nowego użytkownika</h1>

<?php if (!empty($kom)): ?>
    <div class="komunikat <?php echo ($kom === 'Rejestracja zakończyła się sukcesem!') ? 'sukces' : 'blad'; ?>">
        <?php echo htmlspecialchars($kom); ?>
    </div><br>
<?php endif; ?>

<form action="" method="POST">
    <label>Imię:</label><br><br>
    <input type="text" name="imie" placeholder="Imię" value="<?php echo htmlspecialchars($imie); ?>"><br><br>

    <label>Nazwisko:</label><br><br>
    <input type="text" name="nazwisko" placeholder="Nazwisko" value="<?php echo htmlspecialchars($nazwisko); ?>"><br><br>

    <label>Adres e-mail:</label><br><br>
    <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>"><br><br>

    <label>Hasło tymczasowe:</label><br><br>
    <input type="password" name="haslo" placeholder="Hasło tymczasowe"><br><br>

    <label>Rola w systemie:</label><br><br>
    <select name="rola">
        <option value="0">Student (Użytkownik)</option>
        <option value="1">Administrator</option>
    </select><br><br>
    <input type="submit" value="Utwórz konto użytkownika"><br><br>
    <a class="stat-btn" href="admin">Anuluj i wróć</a>
</form>