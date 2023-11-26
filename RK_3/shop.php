<?php
include "databaseconnect.php"; // Подключаем файл с подключением к базе данных

// Запрос данных о товарах и их подписях
$termsQuery = "SELECT * FROM clothes";
$termsResult = mysqli_query($mysql, $termsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_shop.css">
    <title>Магазин</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
        </ul>
    </nav>

    <header>
        <h1>Добро пожаловать в наш магазин одежды!</h1>
    </header>

    <main>
        <div class="box">
            <?php
            // Проверка наличия данных
            if (mysqli_num_rows($termsResult) > 0) {
                // Вывод данных из базы под фотографиями
                $photoCount = 0;
                while ($row = mysqli_fetch_assoc($termsResult)) {
                    echo '<div class="filters__img">';
                    echo '<img title="' . $row['product_name'] . '" src="' . $row['path'] . '" />';
                    echo '<div class="filters__img">' . $row['product_name'] . '</div>';
                    $photoCount++;

                    // Добавляем кнопку только для второй фотографии
                    if ($photoCount == 2) {
                        echo '<a href="cav_empt.php?id=' . $row['id'] . '"><button>Подробнее</button></a>';
                    }

                    echo '</div>';
                }
            } else {
                echo "Нет данных в базе данных.";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>Контактная информация: archive_clothes@email.com</p>
        <p>&copy; 2023 Наш магазин. Все права защищены.</p>
    </footer>

</body>

</html>
