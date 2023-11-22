

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>
    <link href="css/stylePage.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <ul>
            <li><a href="<?php
            $name='Аутентификация';
            $link='autentication.php';
            $current_page=true;
            echo $link;
            ?>"<?php
            if ($current_page) echo ' class="selected-menu"'; 
            ?>><?php
            echo $name;
            ?></a></li>

            <li><a href="<?php  
            $name='Магазин';
            $link='shop.php';
            $current_page=true;
            echo $link;
            ?>"<?php
            if ($current_page) echo ' class="selected-menu"'; 
            ?>><?php
            echo $name;
            ?></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="text-center py-5">
            <h1>О нашем магазине</h1>
        </div>
        <p> Добро пожаловать в наш магазин одежды! Мы предлагаем широкий ассортимент стильной и 
            качественной одежды по доступным ценам. Наша команда стремится 
            делать покупки у нас удобными и приятными для каждого клиента.
    <p>
    </main>

    <div class="box">
            <div class="filters__img_1">
                <img src="images/sovc_slide1.jpg" alt="Фото 1">
                <div class="filters_img_1">NumberNin(e)</div>
            </div>
    </div>


    <footer>
        <p>Контактная информация: archive_clothes@email.com</p>
        <p>&copy; 2023 Наш магазин. Все права защищены.</p>
    </footer>
</body>

</html>
