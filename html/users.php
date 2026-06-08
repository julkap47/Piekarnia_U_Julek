<?php
if (
    !isset($_SESSION['role']) ||
    (int)$_SESSION['role'] !== 1
) {
    header("Location: landing_page");
    exit();
}

$sql_count = "SELECT COUNT(*) AS liczba FROM users";
$result_count = mysqli_query($conn, $sql_count);
$count_row = mysqli_fetch_assoc($result_count);
$liczba_uzytkownikow = $count_row['liczba'];

$sql = "SELECT 
            first_name,
            last_name,
            CASE MONTH(registration_date)
                WHEN 1 THEN CONCAT(DAY(registration_date), ' stycznia ', YEAR(registration_date))
                WHEN 2 THEN CONCAT(DAY(registration_date), ' lutego ', YEAR(registration_date))
                WHEN 3 THEN CONCAT(DAY(registration_date), ' marca ', YEAR(registration_date))
                WHEN 4 THEN CONCAT(DAY(registration_date), ' kwietnia ', YEAR(registration_date))
                WHEN 5 THEN CONCAT(DAY(registration_date), ' maja ', YEAR(registration_date))
                WHEN 6 THEN CONCAT(DAY(registration_date), ' czerwca ', YEAR(registration_date))
                WHEN 7 THEN CONCAT(DAY(registration_date), ' lipca ', YEAR(registration_date))
                WHEN 8 THEN CONCAT(DAY(registration_date), ' sierpnia ', YEAR(registration_date))
                WHEN 9 THEN CONCAT(DAY(registration_date), ' września ', YEAR(registration_date))
                WHEN 10 THEN CONCAT(DAY(registration_date), ' października ', YEAR(registration_date))
                WHEN 11 THEN CONCAT(DAY(registration_date), ' listopada ', YEAR(registration_date))
                WHEN 12 THEN CONCAT(DAY(registration_date), ' grudnia ', YEAR(registration_date))
            END AS data_rejestracji
        FROM users
        ORDER BY registration_date ASC";

$result = mysqli_query($conn, $sql);
?>

<h1>Lista użytkowników</h1>

<p>
    Liczba zarejestrowanych użytkowników:
    <strong><?php echo $liczba_uzytkownikow; ?></strong>
</p>

<table>
    <thead>
        <tr>
            <th>Nazwisko, Imię</th>
            <th>Data rejestracji</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <?php 
                    echo htmlspecialchars($row['last_name']) . ", " . htmlspecialchars($row['first_name']); 
                    ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['data_rejestracji']); ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>