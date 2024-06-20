<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправленной формы
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $passport = $_POST['passport'];
    $tax_id = $_POST['tax_id'];
    $pension_id = $_POST['pension_id'];
    $driver_license = $_POST['driver_license'];
    $additional_docs = $_POST['additional_docs'];
    $notes = $_POST['notes'];

    // Обновление записи в базе данных
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('UPDATE Individuals SET first_name = :first_name, last_name = :last_name, middle_name = :middle_name, passport = :passport, tax_id = :tax_id, pension_id = :pension_id, driver_license = :driver_license, additional_docs = :additional_docs, notes = :notes WHERE id = :id');
        $stmt->execute(['id' => $id, 'first_name' => $first_name, 'last_name' => $last_name, 'middle_name' => $middle_name, 'passport' => $passport, 'tax_id' => $tax_id, 'pension_id' => $pension_id, 'driver_license' => $driver_license, 'additional_docs' => $additional_docs, 'notes' => $notes]);
        echo 'Запись успешно обновлена в таблице Individuals.';
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $host = 'bojack-db';
    $dbname = 'bojack_db';
    $username = 'bojack_user';
    $password = 'P@ssw0rd';

    $id = $_GET['id'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $stmt = $pdo->prepare('SELECT * FROM Individuals WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Редактировать запись</title>
            </head>
            <body>
            <h1>Редактировать запись</h1>
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="first_name">Имя:</label><br>
                <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>"><br><br>

                <label for="last_name">Фамилия:</label><br>
                <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>"><br><br>

                <label for="middle_name">Отчество:</label><br>
                <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>"><br><br>

                <label for="passport">Паспорт:</label><br>
                <input type="text" id="passport" name="passport" value="<?php echo $row['passport']; ?>"><br><br>

                <label for="tax_id">ID налогоплательщика:</label><br>
                <input type="text" id="tax_id" name="tax_id" value="<?php echo $row['tax_id']; ?>"><br><br>

                <label for="pension_id">ID пенсионного фонда:</label><br>
                <input type="text" id="pension_id" name="pension_id" value="<?php echo $row['pension_id']; ?>"><br><br>

                <label for="driver_license">Водительское удостоверение:</label><br>
                <input type="text" id="driver_license" name="driver_license" value="<?php echo $row['driver_license']; ?>"><br><br>

                <label for="additional_docs">Дополнительные документы:</label><br>
                <textarea id="additional_docs" name="additional_docs"><?php echo $row['additional_docs']; ?></textarea><br><br>

                <label for="notes">Примечания:</label><br>
                <textarea id="notes" name="notes"><?php echo $row['notes']; ?></textarea><br><br>

                <input type="submit" value="Сохранить">
            </form>
            </body>
            </html>
            <?php
        } else {
            echo 'Запись с указанным ID не найдена.';
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    echo 'ID записи не указано.';
}
?>