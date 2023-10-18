<?php
$pageTitle = "Аутентификация";
$seconds = date('s');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <link href="../css/style_autentication.css" rel="stylesheet">
</head>
<body>
    <ul>
    <li><a href="<?php  
            $name='На главную';
            $link='index.php';
            $current_page=true;
            echo $link;
            ?>"<?php
            if ($current_page) echo ' class="back-to-home-link_1"'; 
            ?>><?php
            echo $name;
            ?></a></li>
            </ul>
    <form method="POST" action="https://httpbin.org/post">
        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <label class="checkbox-label"><input type="checkbox" name="remember"> Запомнить меня</label>

        <input type="submit" value="Войти">
    </form>
    
    <footer>
    <?php
            date_default_timezone_set('Europe/Moscow');
            $currentDate = date('d.m.Y в H:i:s');
            echo 'Сформировано ' . $currentDate;
            ?>
    </footer>
</body>
</html>
