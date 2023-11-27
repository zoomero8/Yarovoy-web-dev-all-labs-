<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №11</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="header">
    <div class="wrap">
        <nav class="main-menu">
            <?php
            function menuItem($type, $text)
            {
                $isActive = isset($_GET['html_type']) && $_GET['html_type'] == $type;
                echo '<a href="?html_type=' . $type . '&content=' . ($_GET['content'] ?? '') . '"'
                    . ($isActive ? ' class="selected"' : '') . ">$text</a>";
            }

            menuItem('TABLE', 'Табличная верстка');
            menuItem('DIV', 'Блочная верстка');
            ?>
        </nav>
    </div>
</header>

<main>
    <div class="inline" id="product_menu">
        <?php
        function contentLink($value)
        {
            $isActive = (!isset($_GET['content']) && $value == 'n/a') || (isset($_GET['content']) && $_GET['content'] == $value);
            echo '<a href="?content=' . $value . '&html_type=' . ($_GET['html_type'] ?? '') . '"'
                . ($isActive ? ' class="selected"' : '') . '>' . ($value == 'n/a' ? 'Вся таблица умножения' : 'На ' . $value) . '</a>';
        }

        contentLink('n/a');
        for ($i = 2; $i <= 9; $i++) {
            contentLink($i);
        }
        ?>
    </div>

    <section class="exmple">
        <?php
        if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') {
            if (!isset($_GET['content']) || $_GET['content'] == 'n/a') {
                for ($i = 2; $i <= 9; $i++) {
                    outTableForm($i);
                }
            } else {
                outTableForm($_GET['content']);
            }
        } else {
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

<footer class="footer" id="footer">
    <div class="wrap">
        <ul class="footer-info">
            <li class="footer-info_item" style="color: black"><?= getHTMLType() ?></li>
            <li class="footer-info_item" style="color: black"><?= getContent() ?></li>
        </ul>
        <div style="text-align:left">Сформировано <?= date('d.m.Y в H:i\'s') ?></div>
    </div>
</footer>

</body>
</html>

<?php
function outTableForm($n)
{
    echo '<table class="tvRow">';
    outRowTable($n);
    echo '</table>';
}

function outDivForm($n)
{
    echo '<div class="bvRow">';
    outRow($n);
    echo '</div>';
}

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
        echo '<a href="?content=' . $x . '&html_type=' . ($_GET['html_type'] ?? 'TABLE') . '">' . $x . '</a>';
    } else {
        echo $x;
    }
}

function getHTMLType()
{
    if (!isset($_GET['html_type']))
        return 'Верстка не выбрана';
    else if ($_GET['html_type'] == "TABLE")
        return 'Табличная верстка';
    else
        return 'Блочная верстка';
}

function getContent()
{
    if (!isset($_GET['content']) || $_GET['content'] == 'n/a')
        return 'Вся таблица умножения';
    else
        return 'Таблица умножения на ' . $_GET['content'];
}
?>
