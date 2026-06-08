<?php


$kom = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = trim($_POST['email'] ?? '');
    $haslo = trim($_POST['haslo'] ?? '');
    

    if ( $email === "" || $haslo === "" ) {
        $kom = "Nie wszystkie pola są uzupełnione.";
    } 
     else {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $sql = "SELECT user_id, first_name, pass, role FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($haslo, $user['pass'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['imie'] = $user['first_name'];
                    $_SESSION['role']= (int)$user['role'];

                    header("Location: landing_page");
                    exit();
                } else {
                    $kom = "Błędne hasło.";
                }
            } else {
                $kom = "Użytkownik o podanym adresie e-mail nie istnieje.";
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $kom = $e->getMessage();
        }
    }
}
?>

<div style="text-align: center;">

<h1>Zaloguj się</h1>
</div>

<form action="" method="POST">
    <label>Wpisz adres:</label><br><br>
    <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($email); ?>"><br><br>
    
    <label>Wpisz hasło:</label><br><br>
    <input type="password" name="haslo" placeholder="Hasło"><br><br>

    <input type="submit" value="Zaloguj się"><br><br>
    
<?php if (!empty($kom)): ?>
    <div class="komunikat" >
        <?php echo htmlspecialchars($kom); ?>
    </div><br>
<?php endif; ?>
</form>
