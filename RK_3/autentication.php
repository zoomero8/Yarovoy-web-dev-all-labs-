<?php
$pageTitle = "Аутентификация";
$seconds = date('s');

// Подключение к базе данных
include 'databaseconnect.php';

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Подготовка запроса с использованием подготовленных выражений
    $sql = "SELECT * FROM users WHERE user = ? AND password = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Выполнение запроса
    $stmt->execute();

    // Получение результата
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Пользователь найден
        echo "Пользователь найден";
        header("Location: shop.php");
        exit;
    } else {
        // Ошибка: неправильное имя пользователя или пароль
        echo "Неверное имя пользователя или пароль";
    }

    // Закрытие запроса
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link href="css/style_aut.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
</head>

<body>
    <ul>
        <li><a href="index.php">На главную</a></li>
    </ul>

    <form id="loginForm" method="post" action="">
        <label for="username">Логин:</label>
        <!-- Добавлен плейсхолдер для логина -->
        <input type="text" id="username" name="username" required placeholder="Введите логин">

        <label for="password">Пароль:</label>
        <!-- Добавлен плейсхолдер для пароля -->
        <input type="password" id="password" name="password" required placeholder="Введите пароль">

        <!-- Заменено на type="submit" для отправки формы -->
        <input type="submit" value="Войти">
    </form>

    <footer>
        <p>Контактная информация: archive_clothes@email.com</p>
        <p>&copy; 2023 Наш магазин. Все права защищены.</p>
    </footer>
</body>

</html>
