<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$password = $_POST['password'];

// Ищем пользователя в базе данных
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем пароль и выполняем авторизацию
if ($user && password_verify($password, $user['password'])) {
// Устанавливаем cookie с параметрами настроек
setcookie('background_color', $user['background_color'], time() + 3600, '/');
setcookie('font_color', $user['font_color'], time() + 3600, '/');

echo "Авторизация успешна.";
} else {
echo "Неверные учетные данные.";
}
}

// Проверяем, есть ли сохраненные параметры в виде cookie
if (isset($_COOKIE['background_color']) && isset($_COOKIE['font_color'])) {
    // Применяем параметры настроек при повторном входе
    $background_color = $_COOKIE['background_color'];
    $font_color = $_COOKIE['font_color'];
    
    echo "<script>
    document.body.style.backgroundColor = '$background_color';
    document.body.style.color = '$font_color';
    </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Авторизация</title>
</head>
<body>
<h2>Авторизация</h2>
<form method="POST">
<label for="username">Имя пользователя:</label>
<input type="text" id="username" name="username" required>


<label for="password">Пароль:</label>
<input type="password" id="password" name="password" required>


<button type="submit">Войти</button>
</form>
</body>
</html>