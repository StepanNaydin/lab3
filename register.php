<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Вставляем пользователя в базу данных
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

echo "Пользователь зарегистрирован успешно.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Регистрация</title>
</head>
<body>
<h2>Регистрация пользователя</h2>
<form method="POST">
<label for="username">Имя пользователя:</label>
<input type="text" id="username" name="username" required>


<label for="password">Пароль:</label>
<input type="password" id="password" name="password" required>


<button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>