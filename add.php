<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправленной формы
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $passport = $_POST['passport'];
    $tax_id = $_POST['tax_id'];
    $pension_id = $_POST['pension_id'];
    $driver_license = $_POST['driver_license'];
    $additional_docs = $_POST['additional_docs'];
    $notes = $_POST['notes'];

    // Добавление записи в базу данных
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('INSERT INTO Individuals (first_name, last_name, middle_name, passport, tax_id, pension_id, driver_license, additional_docs, notes) VALUES (:first_name, :last_name, :middle_name, :passport, :tax_id, :pension_id, :driver_license, :additional_docs, :notes)');
        $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name, 'middle_name' => $middle_name, 'passport' => $passport, 'tax_id' => $tax_id, 'pension_id' => $pension_id, 'driver_license' => $driver_license, 'additional_docs' => $additional_docs, 'notes' => $notes]);
        echo 'Запись успешно добавлена в таблицу Individuals.';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавить новую запись</title>
</head>
<body>
<h1>Добавить новую запись</h1>
<form method="post" action="">
    <label for="first_name">Имя:</label><br>
    <input type="text" id="first_name" name="first_name"><br><br>

    <label for="last_name">Фамилия:</label><br>
    <input type="text" id="last_name" name="last_name"><br><br>

    <label for="middle_name">Отчество:</label><br>
    <input type="text" id="middle_name" name="middle_name"><br><br>

    <label for="passport">Паспорт:</label><br>
    <input type="text" id="passport" name="passport"><br><br>

    <label for="tax_id">ИНН:</label><br>
    <input type="text" id="tax_id" name="tax_id"><br><br>

    <label for="pension_id">Номер пенсионного свидетельства:</label><br>
    <input type="text" id="pension_id" name="pension_id"><br><br>

    <label for="driver_license">Водительское удостоверение:</label><br>
    <input type="text" id="driver_license" name="driver_license"><br><br>

    <label for="additional_docs">Дополнительные документы:</label><br>
    <textarea id="additional_docs" name="additional_docs"></textarea><br><br>

    <label for="notes">Примечания:</label><br>
    <textarea id="notes" name="notes"></textarea><br><br>

    <input type="submit" value="Добавить запись">
</form>
</body>
</html>
