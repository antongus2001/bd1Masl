<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправленной формы
    $id = $_POST['id'];

    // Удаление записи из базы данных
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('DELETE FROM Individuals WHERE id = :id');
        $stmt->execute(['id' => $id]);
        echo 'Запись успешно удалена из таблицы Individuals.';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo '
    <form method="post">
        <input type="hidden" name="id" value="' . $id . '">
        <p>Вы действительно хотите удалить эту запись из таблицы Individuals?</p>
        <input type="submit" value="Да">
    </form>
    ';
}
?>

