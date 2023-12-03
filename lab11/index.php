<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Мета-теги для корректного отображения и масштабирования на разных устройствах -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Заголовок страницы -->
    <title>Лабораторная работа №11</title>
    <!-- Подключение шрифта Montserrat из Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- Подключение внешнего файла стилей -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Шапка страницы с формой выбора типа верстки и основным меню -->
<header class="header">
    <div class="wrap">
        <!-- Форма с радиокнопками для выбора типа верстки -->
        <form method="get" action="">
            <label>
                <input type="radio" name="html_type" value="TABLE" <?= (isset($_GET['html_type']) && $_GET['html_type'] == 'TABLE') ? 'checked' : '' ?>>
                Табличная верстка
            </label>
            <label>
                <input type="radio" name="html_type" value="DIV" <?= (isset($_GET['html_type']) && $_GET['html_type'] == 'DIV') ? 'checked' : '' ?>>
                Блочная верстка
            </label>
            <button type="submit">Применить</button>
        </form>
        <!-- Основное меню (пока пустое) -->
        <nav class="main-menu">
        </nav>
    </div>
</header>

<!-- Основной контент страницы -->
<main>
    <!-- Блок с ссылками на разные разделы таблицы умножения -->
    <div class="inline" id="product_menu">
        <?php
        // Функция для генерации ссылок с учетом текущих параметров запроса
        function contentLink($value)
        {
            $isActive = (!isset($_GET['content']) && $value == 'n/a') || (isset($_GET['content']) && $_GET['content'] == $value);
            echo '<a href="?content=' . $value . '&html_type=' . ($_GET['html_type'] ?? '') . '"'
                . ($isActive ? ' class="selected"' : '') . '>' . ($value == 'n/a' ? 'Вся таблица умножения' : 'На ' . $value) . '</a>';
        }

        // Генерация ссылок для разделов таблицы умножения
        contentLink('n/a');
        for ($i = 2; $i <= 9; $i++) {
            contentLink($i);
        }
        ?>
    </div>

    <!-- Секция с примерами таблиц умножения или блочных элементов в зависимости от выбранного типа верстки -->
    <section class="exmple">
        <?php
        // Проверка выбранного типа верстки и генерация соответствующего контента
        if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') {
            // Генерация таблицы умножения
            if (!isset($_GET['content']) || $_GET['content'] == 'n/a') {
                for ($i = 2; $i <= 9; $i++) {
                    outTableForm($i);
                }
            } else {
                outTableForm($_GET['content']);
            }
        } else {
            // Генерация блочных элементов
            if (!isset($_GET['content']) || $_GET['content'] == 'n/a') {
                for ($i = 2; $i <= 9; $i++) {
                    outDivForm($i);
                }
            } else {
                outDivForm($_GET['content']);
            }
        }
        ?>
    </section>
</main>

<!-- Нижний колонтитул страницы с дополнительной информацией -->
<footer class="footer" id="footer">
    <div class="wrap">
        <!-- Список для дополнительной информации (пока пуст) -->
        <ul class="footer-info">
        </ul>
        <!-- Блок с датой и выбранными параметрами верстки и контента -->
        <div style="text-align:left">
            Сформировано <?= date('d.m.Y в H:i\'s') ?><br>
            <li class="footer-info_item" style="color: black"><?= getHTMLType() ?></li> <br>
            <li class="footer-info_item" style="color: black"><?= getContent() ?></li>
        </div>
    </div>
</footer>

</body>
</html>

<?php
// Функция для генерации таблицы умножения по переданному множителю
function outTableForm($n)
{
    echo '<table class="tvRow">';
    outRowTable($n);
    echo '</table>';
}

// Функция для генерации блочных элементов по переданному множителю
function outDivForm($n)
{
    echo '<div class="bvRow">';
    outRow($n);
    echo '</div>';
}

// Функция для генерации строки таблицы умножения
function outRow($n)
{
    for ($i = 2; $i <= 9; $i++) {
        echo outNumAsLink($n);
        echo ' x ';
        echo outNumAsLink($i);
        echo ' = ';
        echo outNumAsLink($i * $n) . '<br>';
    }
}

// Функция для генерации строки таблицы умножения
function outRowTable($n)
{
    for ($i = 2; $i <= 9; $i++) {
        echo '<tr><td>';
        echo outNumAsLink($n);
        echo ' x ';
        echo outNumAsLink($i);
        echo '</td><td>';
        echo outNumAsLink($i * $n);
        echo '</td></tr>';
    }
}

// Функция для генерации ссылки на число или вывода числа, если оно больше 9
function outNumAsLink($x)
{
    if ($x <= 9) {
        echo '<a href="?content=' . $x . '&html_type=' . ($_GET['html_type'] ?? 'TABLE') . '">' . $x . '</a>';
    } else {
        echo $x;
    }
}

// Функция для получения текстового представления выбранного типа верстки
function getHTMLType()
{
    if (!isset($_GET['html_type']))
        return 'Верстка не выбрана';
    else if ($_GET['html_type'] == "TABLE")
        return 'Табличная верстка';
    else
        return 'Блочная верстка';
}

// Функция для получения текстового представления выбранного контента
function getContent()
{
    if (!isset($_GET['content']) || $_GET['content'] == 'n/a')
        return 'Вся таблица умножения';
    else
        return 'Таблица умножения на ' . $_GET['content'];
}
?>
