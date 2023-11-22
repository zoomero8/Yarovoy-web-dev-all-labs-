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
            <?php
            function generateInput($name, $label, $type = "number", $required = true)
            {
                echo "<label for=\"$name\" class=\"label\">$label:</label>";
                echo "<input type=\"$type\" name=\"$name\" id=\"$name\" class=\"form-field\" required=\"$required\">";
                echo "<br>";
            }

            generateInput("startArgument", "Начальный аргумент");
            generateInput("numValues", "Количество значений функции");
            generateInput("step", "Шаг");
            generateInput("min_value", "Минимальное значение");
            generateInput("max_value", "Максимальное значение");
            ?>

            <label for="layoutType" class="label">Тип верстки:</label>
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
            $startArgument = isset($_POST["startArgument"]) && is_numeric($_POST["startArgument"]) ? (int)$_POST["startArgument"] : 0;
            $min_value = isset($_POST["min_value"]) && is_numeric($_POST["min_value"]) ? (int)$_POST["min_value"] : PHP_INT_MIN;
            $max_value = isset($_POST["max_value"]) && is_numeric($_POST["max_value"]) ? (int)$_POST["max_value"] : PHP_INT_MAX;
            $numValues = isset($_POST["numValues"]) && is_numeric($_POST["numValues"]) ? (int)$_POST["numValues"] : 0;
            $step = isset($_POST["step"]) && is_numeric($_POST["step"]) ? (int)$_POST["step"] : 0;
            $layoutType = isset($_POST["layoutType"]) ? $_POST["layoutType"] : '';
            $value = 0;
            $min = 0;
            $max = 0;
            $sum = 0;
            $error = 'true';

            function calculateFunction($argument)
            {
                if ($argument <= 10) {
                    return (3 * pow($argument, 2) + 2);
                } elseif ($argument > 10 && $argument < 20) {
                    return (5 * $argument + 7);
                } elseif ($argument == 22) {
                        $error = 'error';
                        return 'error';
                        
                    } else {
                        return ($argument / (22 - $argument));
                    }
            }

            function cycleWithCounter($x, $numValues, $step, $type, $min_value, $max_value, $sum, $min, $max)
            {
                //цикл со счетчиком
                for ($i = 0; $i < $numValues; $i++, $x += $step) {
                    $k = $i + 1;

                    $value = calculateFunction($x);

                    if ($value != 'error') {
                        $sum += $value;
                        $min = min($min, $value);
                        $max = max($max, $value);
                    }

                    switch ($type) {
                        case 'A':
                            "<br><br>";
                            echo "f($x) = $value<br><br>";
                            break;
                        case 'B':
                            "<br><br>";
                            echo "<ul><li>f($x) = $value</li></ul>";
                            break;
                        case 'C':
                            "<br><br>";
                            echo "<ol start='$k'><li>f($x) = $value</li></ol>";
                            break;
                        case 'D':
                            "<br><br>";
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                    <tr>
                                        <td>Шаг</td>
                                        <td>Аргумент функции</td>
                                        <td>Значение функции</td>
                                    </tr>
                                    <tr>
                                        <td>$i</td>
                                        <td>$x</td>
                                        <td>$value</td>
                                    </tr>
                                </table>";
                            break;
                        case 'E':
                            echo '<div style="border: 2px solid red; display: inline-block; margin-right: 8px;">';
                            echo "f($x) = $value";
                            echo '</div>';
                            break;
                        default:
                            echo "f($x) = $value<br><br>";
                    }

                    if ($value >= $max_value || $value < $min_value)
                        break;
                }

                return "<br><br>";
            }

            function cycleWithPrecondition($x, $numValues, $step, $type, $min_value, $max_value, $sum, $min, $max)
            {
                //цикл с предусловием
                $i = 0;
                while ($i < $numValues && ($x <= $max_value && $x >= $min_value)) {
                    $k = $i + 1;

                    $value = calculateFunction($x);

                    if ($value != 'error') {
                        $sum += $value;
                        $min = min($min, $value);
                        $max = max($max, $value);
                    }

                    switch ($type) {
                        case 'A':
                            "<br><br>";
                            echo "f($x) = $value<br><br>";
                            break;
                        case 'B':
                            "<br><br>";
                            echo "<ul><li>f($x) = $value</li></ul>";
                            break;
                        case 'C':
                            "<br><br>";
                            echo "<ol start='$k'><li>f($x) = $value</li></ol>";
                            break;
                        case 'D':
                            "<br><br>";
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                    <tr>
                                        <td>Шаг</td>
                                        <td>Аргумент функции</td>
                                        <td>Значение функции</td>
                                    </tr>
                                    <tr>
                                        <td>$i</td>
                                        <td>$x</td>
                                        <td>$value</td>
                                    </tr>
                                </table>";
                            break;
                            case 'E':
                                echo '<div style="border: 2px solid red; display: block; margin-bottom: 8px;">';
                                echo "f($x) = $value";
                                echo '</div>';
                                break;
                            default:
                                echo "f($x) = $value<br><br>";
                            
                    }

                    $i++;
                    $x += $step;
                }

                return "<br><br>";
            }

            function cycleWithPostcondition($x, $numValues, $step, $type, $min_value, $max_value, $sum, $min, $max)
            {
                //цикл с постусловием
                $i = 0;
                do {
                    $k = $i + 1;

                    $value = calculateFunction($x);

                    if ($value != 'error') {
                        $sum += $value;
                        $min = min($min, $value);
                        $max = max($max, $value);
                    }

                    switch ($type) {
                        case 'A':
                            "<br><br>";
                            echo "f($x) = $value<br><br>";
                            break;
                        case 'B':
                            "<br><br>";
                            echo "<ul><li>f($x) = $value</li></ul>";
                            break;
                        case 'C':
                            "<br><br>";
                            echo "<ol start='$k'><li>f($x) = $value</li></ol>";
                            break;
                        case 'D':
                            "<br><br>";
                            echo "<table border='1' cellspacing='0' cellpadding='10'>
                                    <tr>
                                        <td>Шаг</td>
                                        <td>Аргумент функции</td>
                                        <td>Значение функции</td>
                                    </tr>
                                    <tr>
                                        <td>$i</td>
                                        <td>$x</td>
                                        <td>$value</td>
                                    </tr>
                                </table>";
                            break;
                        case 'E':
                            echo '<div style="border: 2px solid red; display: inline-block; margin-right: 8px;">';
                            echo "f($x) = $value";
                            echo '</div>';
                            break;
                        default:
                            echo "f($x) = $value<br><br>";
                    }

                    $i++;
                    $x += $step;
                } while ($i < $numValues && ($x <= $max_value && $x >= $min_value));

                return "<br><br>";
            }

            $sum = 0;
            $min = PHP_INT_MAX;
            $max = PHP_INT_MIN;

            for ($i = 0; $i < $numValues; $i++) {
                $argument = $startArgument + ($i * $step);
            
                
            
                if ($error != 'error' && $value >= $min_value && $value <= $max_value) {
                    $sum += $value;
                    $min = min($min, $value);
                    $max = max($max, $value);
                    $value = round(calculateFunction($argument), 3);
                } else {
                    echo "<br><br>";
                    echo "<br><br>";
                    break;
                }
            }
            

            "<br><br>";
            echo cycleWithCounter($startArgument, $numValues, $step, $layoutType, $min_value, $max_value, $sum, $min, $max);


        }
        ?>
    </main>

    <footer class="footer">
        <div class="container">
            <?php
            if (!empty($layoutType)) {
                echo "<footer><p>Тип верстки: $layoutType</p></footer>";
            } else {
                $layoutType = 'Верстка еще не выбрана.';
            }
            ?>
            2023 Циклические алгоритмы. Условия в алгоритмах. Табулирование функций
        </div>
    </footer>

</body>

</html>
4 цикл