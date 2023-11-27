<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №10</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header">
        <div class="container text-center py-5">
            <!-- Заголовок страницы -->
            <h1 class="name">Анализ текста</h1>
        </div>
    </header>

    <main class="main">
        <?php
        if (isset($_POST['data']) && $_POST['data']) {
            // Если данные были отправлены через POST и не являются пустыми
            $postData = iconv("utf-8", "cp1251", $_POST['data']);
        
            // Вывод исходного текста с использованием перевода строк
            echo 'Исходный текст:<div class="src_text"><br>' . nl2br($_POST['data']) . '</div><br>';
            echo '<table class="table">';

            // Вызов функции test_it для анализа текста
            test_it($postData);
            // Вызов функции test_symbs для анализа символов в тексте
            $arrSymbs = test_symbs($postData);

            // Вывод таблицы символов в исходном тексте
            echo 'Символы в исходном тексте<table class="table">';
            foreach ($arrSymbs as $key => $value) {
                echo '<tr><td>' . iconv("cp1251", "utf-8", $key) . '</td><td>' . $value . '</td></tr>';
            }
            echo "</table><br>";
        } else {
            // Если данные не были отправлены или пусты
            echo '<div>Нет текста для анализа</div>';
        }

        // Функция для анализа основных характеристик текста
        function test_it($text)
        {
            // Вывод таблицы для анализа основных характеристик текста
            echo '<table class="table">';
            echo '<tr><td>Количество символов </td><td>' . strlen($text) . '</td></tr>';

            // Определение массивов для цифр и знаков препинания
            $cifra = array_flip(range(0, 9));
            $punctuation = array_flip([',', '.', '-', '!', '?', "'", ';']);

            // Инициализация счетчиков
            $cifraAmount = $punctuationCount = $letterCount = $upperCaseCount = $lowerCaseCount = 0;
            $word = '';
            $words = [];

            // Перебор символов в тексте
            for ($i = 0; $i < strlen($text); $i++) {
                if (isset($cifra[$text[$i]]))
                    $cifraAmount++;
                elseif (isset($punctuation[$text[$i]]))
                    $punctuationCount++;
                elseif ($text[$i] != ' ') {
                    $letterCount++;
                    // Подсчет строчных и заглавных букв
                    if (mb_strtolower(iconv("cp1251", "utf-8", $text[$i])) == iconv("cp1251", "utf-8", $text[$i]))
                        $lowerCaseCount++;
                    else
                        $upperCaseCount++;
                }

                // Обработка слов
                if ($text[$i] == ' ' || $text[$i] == ',' || $text[$i] == '.' || $text[$i] == '!' || $text[$i] == '?' || $i == strlen($text) - 1) {
                    if ($text[$i] != ' ' && $text[$i] != ',' && $text[$i] != '.' && $text[$i] != '!' && $text[$i] != '?')
                        $word .= $text[$i];

                    if ($word) {
                        // Подсчет слов в тексте
                        $words[$word] = isset($words[$word]) ? $words[$word] + 1 : 1;
                    }

                    $word = '';  // Сброс текущего слова
                } else {
                    $word .= $text[$i];
                }
            }

            // Вывод результатов анализа
            echo '<tr><td>Количество цифр </td><td>' . $cifraAmount . '</td></tr>';
            echo '<tr><td>Количество знаков препинания </td><td>' . $punctuationCount . '</td></tr>';
            echo '<tr><td>Количество букв </td><td>' . $letterCount . '</td></tr>';
            echo '<tr><td>Количество заглавных букв </td><td>' . $upperCaseCount . '</td></tr>';
            echo '<tr><td>Количество строчных букв </td><td>' . $lowerCaseCount . '</td></tr>';
            echo '<tr><td>Количество слов </td><td>' . count($words) . '</td></tr></table><br>';

            ksort($words);  // Сортировка слов по алфавиту

            // Вывод таблицы слов в исходном тексте
            echo 'Слова в исходном тексте<table class="table">';
            foreach ($words as $key => $value) {
                echo '<tr><td>' . iconv("cp1251", "utf-8", $key) . '</td><td>' . $value . '</td></tr>';
            }
            echo '</table><br>';
        }

        // Функция для подсчета вхождений каждого символа в текст
        function test_symbs($text)
        {
            // Подсчет вхождений каждого символа в текст
            $symbs = [];
            $lText = mb_strtolower(iconv("cp1251", "utf-8", $text));

            $lText = iconv("utf-8", "cp1251", $lText);

            for ($i = 0; $i < strlen($lText); $i++) {
                if (isset($symbs[$lText[$i]]))
                    $symbs[$lText[$i]]++;
                else
                    $symbs[$lText[$i]] = 1;
            }

            return $symbs;  // Возвращение ассоциативного массива символов и их количества
        }
        ?>

        <!-- Ссылка для анализа другого текста -->
        <a type="submit" class="btn" href="index.html">Другой анализ</a>
    </main>

    <footer class="footer">
        <div class="container">
            Основы работы со строковыми данными в PHP. Кодировка. Анализ текста
        </div>
    </footer>
</body>

</html>
