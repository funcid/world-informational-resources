<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    // Параметры подключения к базе данных
    $servername = "mysql_db";  // Имя сервиса в docker-compose.yml
    $username = "student_user";
    $password = "student_password";
    $dbname = "student_db";

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);
    }

    // Создание таблицы
    $sql = "CREATE TABLE IF NOT EXISTS student (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100),
        age INT,
        address BLOB
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Таблица student была успешно создана<br>";
    } else {
        echo "Ошибка создания таблицы: " . $conn->error . "<br>";
    }

    // Вставка записей
    $sql = "INSERT INTO student (name, age, address) VALUES 
            ('Примаков Михаил Андреевич', 22, 'Москва'),
            ('Царюк Артем Владимирович', 21, 'Москва'),
            ('Макаренкова Анастасия Алексеевна', 23, 'Новосибирск')
            ON DUPLICATE KEY UPDATE id=id";

    if ($conn->query($sql) === TRUE) {
        echo "Записи были добавлены<br>";
    } else {
        echo "Ошибка добавления записей: " . $conn->error . "<br>";
    }

    // Чтение второй записи
    $sql = "SELECT * FROM student WHERE id=2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных записи
        while($row = $result->fetch_assoc()) {
            echo "<h2>Вторая запись в таблице:</h2>";
            echo "<p>ID: " . $row["id"]. " - Имя: " . $row["name"]. " - Возраст: " . $row["age"]. " - Адрес: " . $row["address"]. "</p>";
        }
    } else {
        echo "0 результатов";
    }

    // Закрытие соединения
    $conn->close();
    ?>
</body>
</html>
