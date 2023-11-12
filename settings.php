<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$background_color = $_POST['background_color'];
$font_color = $_POST['font_color'];

// Обновляем параметры настроек в базе данных
$stmt = $pdo->prepare("UPDATE users SET background_color = ?, font_color = ? WHERE username = ?");
$stmt->execute([$background_color, $font_color, $_COOKIE['username']]);

// Обновляем cookie с новыми параметрами настроек
setcookie('background_color', $background_color, time() + 3600, '/');
setcookie('font_color', $font_color, time() + 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Настройки</title>
</head>
<body>
<h2>Настройки</h2>
<form method="POST">
<label for="background_color">Фоновый цвет страницы:</label>
<input type="color" id="background_color" name="background_color" value="<?= isset($_COOKIE['background_color']) ? $_COOKIE['background_color'] : '#ffffff' ?>" required>


<label for="font_color">Цвет шрифта:</label>
<input type="color" id="font_color" name="font_color" value="<?= isset($_COOKIE['font_color']) ? $_COOKIE['font_color'] : '#000000' ?>" required>


<button type="submit">Сохранить настройки</button>
</form>
</body>
</html>