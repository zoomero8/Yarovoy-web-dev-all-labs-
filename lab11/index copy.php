<!DOCTYPE html>
<html long="ru">

<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №11</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header">
        <div class="wrap">
            <div class="header_wrap">
            <nav class="main-menu">
            <?php
                $htmlType = $_GET['html_type'] ?? '';
                $content = isset($_GET['content']) ? '&content=' . $_GET['content'] : '';

                echo '<a href="?html_type=TABLE' . $content . '" class="' . ($htmlType == 'TABLE' ? 'selected' : '') . '">Табличная верстка</a>';
                echo '<a href="?html_type=DIV' . $content . '" class="' . ($htmlType == 'DIV' ? 'selected' : '') . '">Блочная верстка</a>';
            ?>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="inline">
            <div id="product_menu">
                <?php
                echo '<a href="?content=n/a';
                if (isset($_GET['html_type']))
                    echo '&html_type=' . $_GET['html_type'];
                echo '"';
                if (!isset($_GET['content']) || $_GET['content'] == "n/a")
                    echo ' class="selected"';
                echo '>Вся таблица умножения</a>';

                for ($i = 2; $i <= 9; $i++) {
                    echo '<a href="?content=' . $i . '';
                    if (isset($_GET['html_type']))
                        echo '&html_type=' . $_GET['html_type'];
                    echo '"';
                    if (isset($_GET['content']) && $_GET['content'] == $i)
                        echo ' class="selected"';
                    echo '>На ' . $i . '</a>';
                }
                ?>
            </div>

            <section class="exmple">
                <?php
                if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE')
                    outTableForm();
                else
                    outDivForm();
                ?>
            </section>
        </div>
    </main>

    <footer class="footer" id="footer">
    <div class="wrap">
        <!-- Блок с датой и выбранными параметрами верстки и контента -->
        <div style="text-align:left">
        <?php
            date_default_timezone_set('Europe/Moscow');
            $currentDate = date('d.m.Y в H:i:s');
            echo 'Сформировано ' . $currentDate;
            ?>
            <br><li class="footer-info_item" style="color: black"><?= getHtmlTypeText() ?></li> <br>
            <li class="footer-info_item" style="color: black"><?= getContentText() ?></li>
        </div>
    </div>
</footer>
</body>

</html>

<?php


// функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В ТАБЛИЧНОЙ ФОРМЕ
function outTableForm()
{
    if (!isset($_GET['content']) || $_GET['content'] == 'n/a') {

        for ($i = 2; $i < 10; $i++) {
            echo '<table class="tvRow">';
            outRowTable($i);
            echo '</table>';
        }
    } else {
        echo '<table class="tvSingleRow">';
        outRowTable($_GET['content']);
        echo '</table>';

    }
}

// функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В БЛОЧНОЙ ФОРМЕ
function outDivForm()
{
    if (!isset($_GET['content']) || $_GET['content'] == "n/a") {
        for ($i = 2; $i < 10; $i++) {
            echo '<div class="bvRow">';
            outRow($i);
            echo '</div>';
        }
    } else {
        echo '<div class="bvSingleRow">';
        outRow($_GET['content']);
        echo '</div>';
    }
}

//функция ВЫВОДИТ СТОЛБЕЦ ТАБЛИЦЫ УМНОЖЕНИЯ ДЛЯ DIV
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

//функция ВЫВОДИТ СТОЛБЕЦ ТАБЛИЦЫ УМНОЖЕНИЯ ДЛЯ TABLE
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

function outNumAsLink($x)
{
    if ($x <= 9) {
        echo '<a href="?content=' . $x . '&html_type=';
        if (!isset($_GET['html_type']))
            echo 'TABLE"';
        else
            echo $_GET['html_type'] . '"';
        echo '>' . $x . '</a>';
    } else
        echo $x;
}

function getHTMLTypeText()
{
    if (!isset($_GET['html_type']))
        return 'Верстка не выбрана';
    else if ($_GET['html_type'] == "TABLE")
        return 'Табличная верстка';
    else
        return 'Блочная верстка';
}

function getContentText()
{
    if (!isset($_GET['content']) || $_GET['content'] == 'n/a')
        return 'Вся таблица умножения';
    else
        return 'Таблица умножения на ' . $_GET['content'];
}

?>