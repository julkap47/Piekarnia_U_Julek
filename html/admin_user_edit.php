<?php
require_once 'db_connect.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || (int)$_SESSION['role'] !== 1) {
    header("Location: page=home");
    exit();
}
$kom = "";
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    echo "Nie podano poprawnego ID użytkownika.";
    exit();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $sql = "SELECT user_id, first_name, last_name, email, role 
            FROM users 
            WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo "Użytkownik o podanym identyfikatorze nie istnieje.";
        exit();
    }

    $user = $result->fetch_assoc();

} catch (mysqli_sql_exception $e) {
    echo "Błąd bazy danych: " . htmlspecialchars($e->getMessage());
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = trim($_POST['imie'] ?? '');
    $nazwisko = trim($_POST['nazwisko'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $haslo = trim($_POST['haslo'] ?? '');
    $rola=(int)($_POST['rola'] ?? 0 );
    if ($rola !== 0 && $rola !== 1) {
        $rola = 0;
    }
    if ($imie === "" || $nazwisko === "" || $email === "" ) {
        $kom = "Nie wszystkie pola są uzupełnione.";
    }else {
        try {
            if ($haslo === "") {
                $sql = "UPDATE users 
                        SET first_name = ?, last_name = ?, email = ?, role = ?
                        WHERE user_id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssii", $imie, $nazwisko, $email, $rola, $id);
            } else {
                $hash = password_hash($haslo, PASSWORD_DEFAULT);

                $sql = "UPDATE users 
                        SET first_name = ?, last_name = ?, email = ?, pass = ?, role = ?
                        WHERE user_id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssii", $imie, $nazwisko, $email, $hash, $rola, $id);
            }

            $stmt->execute();

            header("Location: index.php?page=admin&kom=Użytkownik został zaktualizowany.");
            exit();

        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $kom = "Ten adres e-mail jest już zajęty.";
            } else {
                $kom = "Błąd bazy danych: " . $e->getMessage();
            }
        }
    }
}
?>

<h1>
    Edycja użytkownika:
    <?php 
        if ((int)$user['role'] === 1) {
            echo "Admin";
        } else {
            echo htmlspecialchars($user['first_name']);
        }
    ?>
</h1>
<?php if (!empty($kom)): ?>
    <div class="komunikat <?php echo ($kom === 'Rejestracja zakończyła się sukcesem!') ? 'sukces' : 'blad'; ?>">
        <?php echo htmlspecialchars($kom); ?>
    </div><br>
<?php endif; ?>

<form action="" method="POST">
    <label>Imię:</label><br><br>
    <input type="text" name="imie" placeholder="Imię" value="<?php echo htmlspecialchars($user['first_name']); ?>"><br><br>

    <label>Nazwisko:</label><br><br>
    <input type="text" name="nazwisko" placeholder="Nazwisko" value="<?php echo htmlspecialchars($user['last_name']); ?>"><br><br>

    <label>Adres e-mail:</label><br><br>
    <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($user['email']); ?>"><br><br>

    <label>Nowe hasło (zostaw puste, aby nie zmieniać):</label><br><br>
    <input type="password" name="haslo" placeholder="Hasło tymczasowe"><br><br>

    <label>Rola:</label><br><br>
    <select name="rola">
        <option value="0">Student</option>
        <option value="1">Administrator</option>
    </select><br><br>
    <input type="submit" value="Zapisz zmiany"><br><br>
    <a href="page=admin">Anuluj</a>
</form>