<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №9</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="text-center py-5">
                <h1 class="name">Циклические алгоритмы. Условия в алгоритмах. Табулирование функций</h1>
                <h2>Яровой Денис Романович 221-362</h2>
                <h3>Лабораторная работа №9.3</h3>
            </div>
        </div>
    </header>

    <main class="main">
        <form method="post" action="" class="contact-form">
            <label class="label" for="startArgument">Начальный аргумент:</label>
            <input type="number" name="startArgument" id="startArgument" class="form-field" required>
            <br>
            <label for="numValues">Количество значений функции:</label>
            <input type="number" name="numValues" id="numValues" class="form-field" required>
            <br>
            <label for="step">Шаг:</label>
            <input type="number" name="step" id="step" class="form-field" required>
            <br>
            <label for="layoutType">Тип верстки:</label>
            <select name="layoutType" id="layoutType" class="form-field">
                <option value="A">Тип A</option>
                <option value="B">Тип B</option>
                <option value="C">Тип C</option>
                <option value="D">Тип D</option>
                <option value="E">Тип E</option>
            </select>
            <br>
            <button type="submit" class="btn">Рассчитать</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // валидация и выгрузка значений из формы
            $startArgument = isset($_POST["startArgument"]) && is_numeric($_POST["startArgument"]) ? (int)$_POST["startArgument"] : 0;
            $numValues = isset($_POST["numValues"]) && is_numeric($_POST["numValues"]) ? (int)$_POST["numValues"] : 0;
            $step = isset($_POST["step"]) && is_numeric($_POST["step"]) ? (int)$_POST["step"] : 0;
            $layoutType = isset($_POST["layoutType"]) ? $_POST["layoutType"] : '';
            $values = [];

            for ($i = 0; $i < $numValues; $i++) {
                $k = $i + 1;
                $argument = $startArgument + ($i * $step);


                // Проверка $startArgument перед использованием в формулах
                if ($startArgument == 22) {
                    $value = 'Ошибка, не удовлетворяет ОДЗ';
                } else {
                    $value = ($argument <= 10) ? (3 * pow($startArgument, 2) + 2) : (($argument > 10 && $argument < 20) ? (5 * $argument + 7) : ($argument / (22 - $startArgument)));
                }

                $values[] = $value;

                // Вывод в зависимости от типа верстки
                if ($layoutType == 'A' || $layoutType == 'B' || $layoutType == 'C' || $layoutType == 'D') {
                    if ($layoutType == 'A') {
                        echo "f($argument) = $value<br><br>";
                    } elseif ($layoutType == 'B') {
                        echo "<ul><li>f($argument) = $value</li></ul>";
                    } elseif ($layoutType == 'C') {
                        echo "<ol start='$k'><li>f($argument) = $value</li></ol>";
                    } elseif ($layoutType == 'D') {
                        // Вывод заголовка таблицы
                        echo "<table border='1' cellspacing='0' cellpadding='10'>
                        <tr>
                            <td>№</td>
                            <td>Аргумент</td>
                            <td>Значение функции</td>
                        </tr>";
                           // Вывод строки таблицы
                           echo "<tr>
                           <td>$i</td>
                           <td>$argument</td>
                           <td>$value</td>
                       </tr>";
                        // Закрытие таблицы
                        echo "</table>";
                    }
                    
                } elseif ($layoutType == 'E') {
                    echo "<div class='typeE'>   
                            f($argument) = $value
                        </div>";
                }
            }

            // Вычисление дополнительных статистических данных
            if (!empty($values)) {
                $maxim = max($values);
                $minim = min($values);
                $avg = count($values) > 0 ? array_sum($values) / count($values) : 0;
                $summa = array_sum($values);

            echo "<br>Максимальное значение: $maxim<br><br>";
            echo "Минимальное значение: $minim<br><br>";
            echo "Среднее арифметическое: $avg<br><br>";
            echo "Сумма значений: $summa<br>";
            } else {
                // обработка случая, когда $values пуст
                $maxim = 'Массив значений пуст';
            }
        }
        ?>
    </main>

    <footer class="footer">
        <div class="container">
        <?php
            if (!empty($layoutType)){
            echo "<footer><p>Тип верстки: $layoutType</p></footer>";
            } else{
                $layoutType = 'Верстка еще не выбрана.';
            }
            ?>   
            2023 Циклические алгоритмы. Условия в алгоритмах. Табулирование функций
        </div>
    </footer>

</body>

</html>
