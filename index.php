<?php
$host = 'bojack-db';
$dbname = 'bojack_db';
$username = 'bojack_user';
$password = 'P@ssw0rd';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $stmt = $pdo->query('SELECT * FROM Individuals');
    echo '<table>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '<td><a href="edit.php?id=' . $row['id'] . '">Редактировать</a></td>';
        echo '<td><a href="delete.php?id=' . $row['id'] . '">Удалить</a></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<a href="add.php">Добавить новую запись</a>';
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
