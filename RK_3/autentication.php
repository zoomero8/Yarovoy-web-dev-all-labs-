<?php
$pageTitle = "Аутентификация";
$seconds = date('s');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link href="css/style_aut.css" rel="stylesheet">
</head>

<body>
    <ul>
        <li><a href="index.php">На главную</a></li>
    </ul>

    <form id="loginForm">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <label class="checkbox-label"><input type="checkbox" name="remember"> Запомнить меня</label>

        <input type="button" value="Войти" onclick="login()">
    </form>

    <footer>
        <p>Контактная информация: archive_clothes@email.com</p>
        <p>&copy; 2023 Наш магазин. Все права защищены.</p>
    </footer>

    <script>
        function login() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>
