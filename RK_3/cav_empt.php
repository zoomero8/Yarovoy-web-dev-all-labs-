

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
            $link='shop.html';
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
            <h1>Cav empt Hoodie</h1>
        </div>
        <p> Cav Empt, также известный как C.E, — это бренд уличной одежды, базирующийся в Токио, Япония. 
            Бренд был основан в 2011 году Тоби Фелтвеллом и Sk8thing, оба из которых имеют большой опыт работы в области дизайна одежды. 
            Cav Empt известен своими смелыми графическими рисунками, негабаритными силуэтами и уникальным использованием цветов и узоров.
    <p>
    </main>

    <div class="box">
            <div class="filters__img_1">
                <img src="images/cav_slide4.webp" alt="Фото 1">
                <div class="filters_img">Cav empt 300$</div>
            </div>
    </div>


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
<script>
        // JavaScript для динамического добавления элементов навигации
        const navData = [
            { name: 'Аутентификация', link: 'autentication.php', currentPage: true },
            { name: 'Магазин', link: 'shop.html', currentPage: false }
        ];

        const navElement = document.getElementById('mainNav');

        navData.forEach(item => {
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.href = item.link;
            link.textContent = item.name;
            if (item.currentPage) {
                link.classList.add('selected-menu');
            }
            listItem.appendChild(link);
            navElement.querySelector('ul').appendChild(listItem);
        });
    </script>

</html>
