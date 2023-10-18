<?php
$seconds = date('s');
$imageClass1 = ($seconds % 2 == 0) ? 'image/CSS_pic_1.jpg' : 'image/CSS_pic_2.png';
$imageClass2 = ($seconds % 2 == 0) ? 'image/CSS_pic_3.jpeg' : 'image/CSS_pic_5.jpg';
$pageTitle = 'CSS';

$infotable = array(
    array('Свойство', 'Значение', 'Описание'),
    array('Color-font', 'Font-size', 'Background'),
    array('Black', '10px', 'Green'),
);
?>

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
            $name='Обратная связь';
            $link='feedback.php';
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
            <h1><?php echo $pageTitle; ?></h1>
        </div>
    </main>

    <h2 id="section1">Таблица</h2>
    <table>
                <?php foreach ($infotable as $option) :?>
                    <tr>
                        <?php foreach ($option as $cell) :?>
                            <td><?php echo $cell; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>

    <h2 id="section2">Фото</h2>
    <div style="display: flex; justify-content: center;">
    <img src=<?php echo $imageClass1; ?> alt="CSS" width="900px" height="600px">
    </div>

    <div style="display: flex; justify-content: center;">
    <img src=<?php echo $imageClass2; ?> alt="CSS" width="900px" height="600px">
    </div>

    <h2 id="section3">Текст</h2>
    <p> CSS (Cascading Style Sheets) - это язык стилей, который
        используется для оформления веб-страниц. Он определяет,
        как элементы веб-страницы должны быть отображены на экране,
        включая цвета, шрифты, размеры, расположение и другие аспекты
        внешнего вида. CSS работает в паре с HTML, который определяет
        структуру содержимого страницы. Используя CSS, вы можете
        изменять внешний вид веб-страниц и создавать стильное и
        привлекательное оформление.
    <p>

    <footer>
        <p>Контактная информация</p>
        <p>Почта: yadenis8579@gmail.com</p>
        <p>г. Москва ул. Прянишникова 2А</p>
        
        <?php
            date_default_timezone_set('Europe/Moscow');
            $currentDate = date('d.m.Y в H:i:s');
            echo 'Сформировано ' . $currentDate;
            ?>
    </footer>
</body>

</html>
