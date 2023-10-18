<?php
include "databaseconnect.php"; // Подключаем файл с подключением к базе данных

// Запрос данных о терминах и их определениях
$termsQuery = "SELECT * FROM termins";
$termsResult = mysqli_query($mysql, $termsQuery);

// Запрос данных о изображениях
$imagesQuery = "SELECT * FROM images";
$imagesResult = mysqli_query($mysql, $imagesQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSS</title>
  <link href="css/styleDisplay_data.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin&display=swap" rel="stylesheet">
<body>
    <h1>Термины и определения:</h1>
    <table>
        <tr>
            <th>Термин</th>
            <th>Определение</th>
        </tr>
        <?php
        while ($termins = mysqli_fetch_assoc($termsResult)) {
            echo "<tr>";
            echo "<td>" . $termins['termins'] . "</td>";
            echo "<td>" . $termins['definition'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Изображения:</h1>
    <div class="box">
        <?php
        while ($image = mysqli_fetch_assoc($imagesResult)) {
            echo '<div class="filters__img">';
            echo '<img title="' . $image['images_name'] . '"src="' . $image['images_path'] . '" />';
            echo '</div>';
        }
        ?>
    </div>
</body>
<footer>
      <p>Контактная информация</p>
      </p>Почта: yadenis8579@gmail.com
      </p> г. Москва ул. Прянишникова 2А
    </footer>
</html>
